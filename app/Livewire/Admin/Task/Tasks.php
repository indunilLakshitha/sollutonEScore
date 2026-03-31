<?php

namespace App\Livewire\Admin\Task;

use App\Livewire\Admin\Task\Concerns\WithAssignUserPicker;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use App\Models\UserPerformance;
use App\Services\ManagementIncomeService;
use App\Services\TaskNotificationMessenger;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Tasks extends Component
{
    use WithAssignUserPicker;
    use WithPagination;

    public string $search = '';

    /** Filter tasks by `created_at` (Y-m-d). Single day overrides month and range. */
    public ?string $filterCreatedDay = null;

    /** Filter by calendar month (YYYY-MM). Used if day is empty. */
    public ?string $filterCreatedMonth = null;

    /** Inclusive range on `created_at`; used if day and month are empty. */
    public ?string $filterCreatedFrom = null;

    public ?string $filterCreatedTo = null;

    public string $section = 'all';

    public bool $showAssignModal = false;

    public ?int $assigningTaskId = null;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingSection(): void
    {
        $this->resetPage();
    }

    public function updatedFilterCreatedDay(): void
    {
        $this->resetPage();
    }

    public function updatedFilterCreatedMonth(): void
    {
        $this->resetPage();
    }

    public function updatedFilterCreatedFrom(): void
    {
        $this->resetPage();
    }

    public function updatedFilterCreatedTo(): void
    {
        $this->resetPage();
    }

    public function clearDateFilters(): void
    {
        $this->filterCreatedDay = null;
        $this->filterCreatedMonth = null;
        $this->filterCreatedFrom = null;
        $this->filterCreatedTo = null;
        $this->resetPage();
    }

    /**
     * Exclude users who already have an assignment for this task definition.
     */
    public function getAssignModalUserResultsProperty()
    {
        $s = trim($this->assignUserSearch);
        if ($s === '') {
            return collect();
        }

        $excludeIds = [];
        if ($this->assigningTaskId !== null) {
            $template = Task::query()->whereKey($this->assigningTaskId)->first();
            if ($template) {
                $excludeIds = Task::assignedUserIdsForDefinition($template);
            }
        }

        return User::query()
            ->whereNotIn('id', $excludeIds)
            ->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                    ->orWhere('reg_no', 'like', "%{$s}%");
            })
            ->orderBy('name')
            ->limit(25)
            ->get(['id', 'name', 'reg_no']);
    }

    public function openAssignModal(int $taskId): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $task = Task::query()->whereKey($taskId)->firstOrFail();
        if ($task->is_expired || !in_array($task->status, [
            Task::STATUS_UNASSIGNED,
            Task::STATUS_ASSIGNED,
            Task::STATUS_SUBMITTED,
        ], true)) {
            $this->dispatch('success_alert', ['title' => 'Only active and non-expired tasks can be assigned from the list.']);

            return;
        }

        $this->assigningTaskId = $taskId;
        $this->assignUserSearch = '';
        $this->selectedUserIds = [];
        $this->selectedRoleIds = [];
        $this->showAssignModal = true;
    }

    public function closeAssignModal(): void
    {
        $this->showAssignModal = false;
        $this->assigningTaskId = null;
        $this->assignUserSearch = '';
        $this->selectedUserIds = [];
        $this->selectedRoleIds = [];
    }

    public function assignSelectedUsers(): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $this->selectedUserIds = array_values(array_unique(array_filter(
            array_map('intval', $this->selectedUserIds ?? []),
            static fn (int $id): bool => $id > 0
        )));
        $this->selectedRoleIds = array_values(array_unique(array_filter(
            array_map('intval', $this->selectedRoleIds ?? []),
            static fn (int $id): bool => $id > 0
        )));

        $this->validate([
            'selectedUserIds' => 'array',
            'selectedUserIds.*' => 'integer|exists:users,id',
            'selectedRoleIds' => 'array',
            'selectedRoleIds.*' => 'integer|exists:roles,id',
        ]);

        if ($this->assigningTaskId === null) {
            return;
        }

        $template = Task::query()->whereKey($this->assigningTaskId)->firstOrFail();
        if ($template->is_expired || !in_array($template->status, [
            Task::STATUS_UNASSIGNED,
            Task::STATUS_ASSIGNED,
            Task::STATUS_SUBMITTED,
        ], true)) {
            $this->closeAssignModal();
            $this->dispatch('success_alert', ['title' => 'This task can no longer be assigned.']);

            return;
        }

        $alreadyAssigned = array_flip(Task::assignedUserIdsForDefinition($template));

        $userPickIds = $this->selectedUserIds;
        $roleIds = $this->selectedRoleIds;
        $fromRoles = [];
        if ($roleIds !== []) {
            $roleCandidates = User::query()
                ->whereIn('role_id', $roleIds)
                ->where('active_status', User::UNBLOCKED)
                ->pluck('id')
                ->map(fn ($id) => (int) $id)
                ->all();

            if ($userPickIds === [] && $roleCandidates === []) {
                $this->addError('selectedRoleIds', 'No active users found for the selected role(s).');

                return;
            }

            if ($userPickIds === [] && $roleCandidates !== [] && ! array_filter(
                $roleCandidates,
                static fn (int $id): bool => ! isset($alreadyAssigned[$id])
            )) {
                $this->addError(
                    'selectedRoleIds',
                    'All active members in the selected role(s) are already assigned to this task.'
                );

                return;
            }

            $fromRoles = array_values(array_filter(
                $roleCandidates,
                static fn (int $id): bool => ! isset($alreadyAssigned[$id])
            ));
        }

        $ids = array_values(array_unique(array_merge($userPickIds, $fromRoles)));

        if ($ids === []) {
            $this->addError('selectedUserIds', 'Select at least one member or one role.');

            return;
        }

        $toAssign = array_values(array_filter(
            $ids,
            static fn (int $userId): bool => ! isset($alreadyAssigned[$userId])
        ));
        $skipped = count($ids) - count($toAssign);

        if ($toAssign === []) {
            $this->closeAssignModal();
            $this->dispatch('failed_alert', title: 'Those members are already assigned to this task.');

            return;
        }

        $templateHadUid = ($template->task_uid !== null && $template->task_uid !== '');
        $taskUid = $templateHadUid ? (string) $template->task_uid : Task::allocateNextTaskUid();

        DB::transaction(function () use ($template, $toAssign, $taskUid, $templateHadUid) {
            if (! $templateHadUid) {
                Task::queryMatchingFields($template)->update(['task_uid' => $taskUid]);
                $template->refresh();
            }

            foreach ($toAssign as $userId) {
                $row = $template->replicate();
                $row->assigned_user_id = $userId;
                $row->status = Task::STATUS_ASSIGNED;
                $row->submission_note = null;
                $row->submitted_at = null;
                $row->score = null;
                $row->approved_at = null;
                $row->rejected_at = null;
                $row->task_uid = $taskUid;
                $row->save();
            }

            if ($template->status === Task::STATUS_UNASSIGNED) {
                $template->delete();
            }
        });

        $this->sendAssignmentNotifications($template, $toAssign);
        $this->closeAssignModal();
        if ($skipped > 0) {
            $this->dispatch('success_alert', title: 'Users assigned. '.$skipped.' skipped (already assigned).');
        } else {
            $this->dispatch('success_alert', title: 'Users assigned.');
        }
    }

    public function markApproved(int $id, int $score = 0): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $task = Task::query()->whereKey($id)->firstOrFail();

        if ($task->is_expired) {
            $task->status = Task::STATUS_REJECTED;
            $task->rejected_at = now();
            $task->score = 0;
            $task->save();
            $this->syncUserPerformanceForTask($task);
            $this->sendTaskStatusNotifications($task, 'rejected');
            $this->dispatch('success_alert', ['title' => 'Task expired. Score set to 0.']);

            return;
        }

        $max = (int) ($task->max_score ?? 0);
        $score = max(0, min($max, $score));

        $task->status = Task::STATUS_APPROVED;
        $task->approved_at = now();
        $task->rejected_at = null;
        $task->score = $score;
        $task->save();
        $this->syncUserPerformanceForTask($task);
        $this->sendTaskStatusNotifications($task, 'approved');

        $this->dispatch('success_alert', ['title' => 'Task approved.']);
    }

    public function markRejected(int $id): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $task = Task::query()->whereKey($id)->firstOrFail();
        $task->status = Task::STATUS_REJECTED;
        $task->rejected_at = now();
        $task->approved_at = null;
        $task->score = 0;
        $task->save();
        $this->syncUserPerformanceForTask($task);
        $this->sendTaskStatusNotifications($task, 'rejected');

        $this->dispatch('success_alert', ['title' => 'Task rejected.']);
    }

    public function delete(int $id): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        Task::query()->whereKey($id)->delete();
        $this->dispatch('success_alert', ['title' => 'Task deleted.']);
    }

    public function render()
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $tasks = Task::query()
            ->with(['category:id,name', 'assignedUser:id,name,reg_no'])
            ->when($this->section === 'all', function ($q) {
                $q->whereIn('status', [
                    Task::STATUS_UNASSIGNED,
                    Task::STATUS_ASSIGNED,
                    Task::STATUS_SUBMITTED,
                ])->where(function ($qq) {
                    $qq->whereNull('deadline_at')
                        ->orWhere('deadline_at', '>=', now());
                });
            })
            ->when($this->section === 'pending_assignment', fn ($q) => $q->where('status', Task::STATUS_UNASSIGNED))
            ->when($this->section === 'assigned', fn ($q) => $q->where('status', Task::STATUS_ASSIGNED))
            ->when($this->section === 'assignment_complete', fn ($q) => $q->where('status', Task::STATUS_SUBMITTED))
            ->when($this->section === 'approve', fn ($q) => $q->where('status', Task::STATUS_APPROVED))
            ->when($this->section === 'reject', fn ($q) => $q->where('status', Task::STATUS_REJECTED))
            ->when($this->section === 'completed', fn ($q) => $q->whereIn('status', [Task::STATUS_APPROVED, Task::STATUS_REJECTED]))
            ->when($this->search !== '', function ($q) {
                $s = trim($this->search);
                $q->where(function ($qq) use ($s) {
                    $qq->where('name', 'like', "%{$s}%")
                        ->orWhereHas('assignedUser', fn ($u) => $u->where('name', 'like', "%{$s}%")->orWhere('reg_no', 'like', "%{$s}%"))
                        ->orWhereHas('category', fn ($c) => $c->where('name', 'like', "%{$s}%"));
                });
            })
            ->tap(fn ($q) => $this->applyCreatedAtFilter($q))
            ->orderByDesc('id')
            ->paginate(15);

        $assignRoles = Role::query()->orderBy('sort_order')->orderBy('id')->get(['id', 'name']);

        return view('livewire.admin.task.tasks', compact('tasks', 'assignRoles'));
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Builder<\App\Models\Task>  $q
     */
    private function applyCreatedAtFilter($q): void
    {
        $day = trim((string) ($this->filterCreatedDay ?? ''));
        if ($day !== '') {
            try {
                $start = Carbon::parse($day)->startOfDay();
                $end = $start->copy()->endOfDay();
                $q->whereBetween('deadline_at', [$start, $end]);
            } catch (\Throwable) {
                // ignore invalid date
            }

            return;
        }

        $month = trim((string) ($this->filterCreatedMonth ?? ''));
        if ($month !== '') {
            try {
                $start = Carbon::createFromFormat('Y-m', $month)->startOfMonth();
                $end = $start->copy()->endOfMonth();
                $q->whereBetween('deadline_at', [$start, $end]);
            } catch (\Throwable) {
                // ignore invalid month
            }

            return;
        }

        $from = trim((string) ($this->filterCreatedFrom ?? ''));
        $to = trim((string) ($this->filterCreatedTo ?? ''));
        if ($from === '' && $to === '') {
            return;
        }

        try {
            if ($from !== '' && $to !== '') {
                $start = Carbon::parse($from)->startOfDay();
                $end = Carbon::parse($to)->endOfDay();
                if ($start->lte($end)) {
                    $q->whereBetween('deadline_at', [$start, $end]);
                }
            } elseif ($from !== '') {
                $q->where('deadline_at', '>=', Carbon::parse($from)->startOfDay());
            } else {
                $q->where('deadline_at', '<=', Carbon::parse($to)->endOfDay());
            }
        } catch (\Throwable) {
            // ignore invalid dates
        }
    }

    private function syncUserPerformanceForTask(Task $task): void
    {
        if (!$task->assigned_user_id) {
            return;
        }

        // Performance for a month depends on:
        // - assigned_total: uses tasks `created_at` month
        // - approved_total: uses tasks `approved_at` month (only when status is APPROVED)
        // So we update:
        // - approved tasks using `approved_at` month
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

    /**
     * @param array<int, int> $userIds
     */
    private function sendAssignmentNotifications(Task $taskTemplate, array $userIds): void
    {
        if (empty($userIds)) {
            return;
        }

        $messenger = app(TaskNotificationMessenger::class);
        $users = User::query()
            ->whereIn('id', $userIds)
            ->get(['id', 'name', 'first_name', 'mobile_no', 'email']);

        foreach ($users as $user) {
            $body = $messenger->assignmentMessage($user, $taskTemplate);
            $messenger->notify($user, 'Task assigned: '.$taskTemplate->name, $body);
        }
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
