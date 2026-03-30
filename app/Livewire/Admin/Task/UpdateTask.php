<?php

namespace App\Livewire\Admin\Task;

use App\Models\Task;
use App\Models\TaskCategory;
use App\Models\UserPerformance;
use App\Services\ManagementIncomeService;
use App\Services\TaskNotificationMessenger;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdateTask extends Component
{
    public int $id;

    public string $name = '';
    public int $taskCategoryId = 0;
    public int $maxScore = 0;
    public ?string $deadlineAt = null; // datetime-local
    public ?string $submissionNote = null;
    public string $status = Task::STATUS_ASSIGNED;
    public ?int $score = null; // only set on approval

    public bool $isExpired = false;

    public ?string $assignedUserLabel = null;

    public $categories;

    public function mount($id): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $task = Task::query()->with(['category', 'assignedUser'])->whereKey($id)->firstOrFail();
        $this->id = (int) $task->id;

        $this->name = $task->name;
        $this->taskCategoryId = (int) $task->task_category_id;
        $this->maxScore = (int) ($task->max_score ?? 0);
        $this->deadlineAt = $task->deadline_at ? $task->deadline_at->format('Y-m-d\\TH:i') : null;
        $this->submissionNote = $task->submission_note;
        $this->status = $task->status;
        $this->score = $task->score;
        $this->isExpired = $task->is_expired;

        // Approve screen: pre-fill award score with max score (still editable before APPROVE).
        if ($task->status === Task::STATUS_SUBMITTED
            && !$task->is_expired
            && $this->score === null) {
            $this->score = (int) ($task->max_score ?? 0);
        }

        $this->assignedUserLabel = $task->assignedUser
            ? $task->assignedUser->name.' ('.$task->assignedUser->reg_no.')'
            : null;

        $this->categories = TaskCategory::query()->where('is_active', 1)->orderBy('name')->get();
    }

    public function save(): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $this->validate([
            'name' => 'required|string|max:255',
            'taskCategoryId' => 'required|integer|exists:task_categories,id',
            'maxScore' => 'required|integer|min:0|max:100000',
            'deadlineAt' => 'nullable|date',
        ]);

        $task = Task::query()->whereKey($this->id)->firstOrFail();
        $task->name = $this->name;
        $task->task_category_id = $this->taskCategoryId;
        $task->max_score = $this->maxScore;
        $task->deadline_at = $this->deadlineAt ? date('Y-m-d H:i:s', strtotime($this->deadlineAt)) : null;
        $task->save();

        $this->dispatch('success_alert', ['title' => 'Task updated.']);
    }

    public function approve()
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $task = Task::query()->whereKey($this->id)->firstOrFail();

        if ($task->is_expired) {
            $task->status = Task::STATUS_REJECTED;
            $task->rejected_at = now();
            $task->score = 0;
            $task->save();
            $this->syncUserPerformanceForTask($task);
            $this->sendTaskStatusNotifications($task, 'rejected');
            session()->flash('task_flash_success', 'Task expired. Score set to 0.');

            return $this->redirect(route('admin.task.index'));
        }

        $this->validate([
            'score' => 'required|integer|min:0|max:' . ((int) ($task->max_score ?? 0)),
        ]);

        $task->status = Task::STATUS_APPROVED;
        $task->approved_at = now();
        $task->rejected_at = null;
        $task->score = (int) $this->score;
        $task->save();
        $this->syncUserPerformanceForTask($task);
        $this->sendTaskStatusNotifications($task, 'approved');

        session()->flash('task_flash_success', 'Task approved.');

        return $this->redirect(route('admin.task.index'));
    }

    public function reject()
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $task = Task::query()->whereKey($this->id)->firstOrFail();
        $task->status = Task::STATUS_REJECTED;
        $task->rejected_at = now();
        $task->approved_at = null;
        $task->score = 0;
        $task->save();
        $this->syncUserPerformanceForTask($task);
        $this->sendTaskStatusNotifications($task, 'rejected');

        session()->flash('task_flash_success', 'Task rejected.');

        return $this->redirect(route('admin.task.index'));
    }

    public function render()
    {
        return view('livewire.admin.task.update-task');
    }

    private function syncUserPerformanceForTask(Task $task): void
    {
        if (!$task->assigned_user_id) {
            return;
        }

        // Performance for a month depends on:
        // - assigned_total: tasks `created_at` month
        // - approved_total: tasks `approved_at` month (only when status is APPROVED)
        // So we update:
        // - APPROVED tasks using `approved_at` month
        // - non-approved tasks (rejected/expired) using `created_at` month
        $baseDate = $task->status === Task::STATUS_APPROVED
            ? ($task->approved_at ?? $task->created_at ?? now())
            : ($task->created_at ?? now());
        $year = (int) $baseDate->format('Y');
        $month = (int) $baseDate->format('n');

        $approvedTotal = (int) Task::query()
            ->where('assigned_user_id', $task->assigned_user_id)
            ->where('status', Task::STATUS_APPROVED)
            ->whereYear('approved_at', $year)
            ->whereMonth('approved_at', $month)
            ->sum('score');

        $assignedTotal = (int) Task::query()
            ->where('assigned_user_id', $task->assigned_user_id)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->sum('max_score');

        $performance = $assignedTotal > 0
            ? round(($approvedTotal / $assignedTotal) * 100, 2)
            : 0.0;

        UserPerformance::query()->updateOrCreate(
            [
                'user_id' => (int) $task->assigned_user_id,
                'year' => $year,
                'month' => $month,
            ],
            [
                'approved_score_total' => $approvedTotal,
                'assigned_score_total' => $assignedTotal,
                'performance' => $performance,
            ]
        );

        app(ManagementIncomeService::class)->syncForMonth($year, $month);
    }

    private function sendTaskStatusNotifications(Task $task, string $status): void
    {
        $task->loadMissing('assignedUser:id,name,first_name,mobile_no,email');
        $user = $task->assignedUser;
        if (!$user) {
            return;
        }

        $messenger = app(TaskNotificationMessenger::class);
        $body = $messenger->taskStatusMessage($user, $task, $status);
        $subject = $status === 'approved'
            ? 'Task approved: '.$task->name
            : 'Task rejected: '.$task->name;
        $messenger->notify($user, $subject, $body);
    }
}
