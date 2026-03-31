<?php

namespace App\Livewire\Admin\Task;

use App\Livewire\Admin\Task\Concerns\WithAssignUserPicker;
use App\Models\Role;
use App\Models\Task;
use App\Models\TaskCategory;
use App\Models\User;
use App\Services\TaskNotificationMessenger;
use App\Support\HtmlSanitizer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateTask extends Component
{
    use WithAssignUserPicker;

    public string $name = '';

    public ?string $description = null;

    public int $taskCategoryId = 0;

    public int $maxScore = 0;

    public ?string $deadlineAt = null; // datetime-local

    public $categories;

    public function mount(): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $this->categories = TaskCategory::query()->where('is_active', 1)->orderBy('name')->get();
    }

    /**
     * Exclude users who already have this task definition assigned.
     */
    public function getAssignModalUserResultsProperty()
    {
        $s = trim($this->assignUserSearch);
        if ($s === '') {
            return collect();
        }

        $excludeIds = [];
        if ($this->taskCategoryId > 0 && trim($this->name) !== '') {
            $deadlineDb = $this->deadlineAt ? date('Y-m-d H:i:s', strtotime($this->deadlineAt)) : null;
            $probe = new Task([
                'task_category_id' => $this->taskCategoryId,
                'name' => $this->name,
                'max_score' => $this->maxScore,
            ]);
            $probe->setAttribute('deadline_at', $deadlineDb);
            $excludeIds = Task::assignedUserIdsForDefinition($probe);
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

    public function save(): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'taskCategoryId' => 'required|integer|exists:task_categories,id',
            'maxScore' => 'required|integer|min:0|max:100000',
            'deadlineAt' => 'nullable|date',
            'selectedUserIds' => 'nullable|array',
            'selectedUserIds.*' => 'integer|exists:users,id',
            'selectedRoleIds' => 'nullable|array',
            'selectedRoleIds.*' => 'integer|exists:roles,id',
        ]);

        $deadlineDb = $this->deadlineAt ? date('Y-m-d H:i:s', strtotime($this->deadlineAt)) : null;
        $desc = HtmlSanitizer::basic($this->description);

        $definitionProbe = new Task([
            'task_category_id' => $this->taskCategoryId,
            'name' => $this->name,
            'max_score' => $this->maxScore,
        ]);
        $definitionProbe->setAttribute('deadline_at', $deadlineDb);
        $alreadyAssigned = array_flip(Task::assignedUserIdsForDefinition($definitionProbe));

        $userPickIds = array_values(array_unique(array_map('intval', $this->selectedUserIds)));
        $roleIds = array_values(array_unique(array_map('intval', $this->selectedRoleIds)));
        $fromRoles = [];
        if ($roleIds !== []) {
            $roleCandidates = User::query()
                ->whereIn('role_id', $roleIds)
                ->where('active_status', User::UNBLOCKED)
                ->pluck('id')
                ->map(fn ($id) => (int) $id)
                ->all();

            if ($userPickIds === [] && $roleCandidates === []) {
                $this->dispatch('failed_alert', title: 'No active users found for the selected role(s).');

                return;
            }

            if ($userPickIds === [] && $roleCandidates !== [] && ! array_filter(
                $roleCandidates,
                static fn (int $id): bool => ! isset($alreadyAssigned[$id])
            )) {
                $this->dispatch(
                    'failed_alert',
                    title: 'All active members in the selected role(s) are already assigned to this task.',
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
            Task::query()->create([
                'task_uid' => Task::allocateNextTaskUid(),
                'name' => $this->name,
                'description' => $desc,
                'task_category_id' => $this->taskCategoryId,
                'assigned_user_id' => null,
                'max_score' => $this->maxScore,
                'deadline_at' => $deadlineDb,
                'status' => Task::STATUS_UNASSIGNED,
            ]);
            $this->dispatch('success_alert', ['title' => 'Task created. Assign users from the task list if needed.']);
        } else {
            $toAssign = array_values(array_filter(
                $ids,
                static fn (int $userId): bool => ! isset($alreadyAssigned[$userId])
            ));

            if ($toAssign === []) {
                $this->dispatch('failed_alert', title: 'Selected members are already assigned to this task.');

                return;
            }

            DB::transaction(function () use ($deadlineDb, $toAssign, $desc) {
                $taskUid = Task::allocateNextTaskUid();
                foreach ($toAssign as $userId) {
                    Task::query()->create([
                        'task_uid' => $taskUid,
                        'name' => $this->name,
                        'description' => $desc,
                        'task_category_id' => $this->taskCategoryId,
                        'assigned_user_id' => $userId,
                        'max_score' => $this->maxScore,
                        'deadline_at' => $deadlineDb,
                        'status' => Task::STATUS_ASSIGNED,
                    ]);
                }
            });

            $skipped = count($ids) - count($toAssign);
            $this->sendAssignmentNotifications($toAssign, $deadlineDb);
            if ($skipped > 0) {
                $this->dispatch('success_alert', [
                    'title' => 'Task created and assigned to '.count($toAssign).' member(s). '.$skipped.' skipped (already assigned).',
                ]);
            } else {
                $this->dispatch('success_alert', [
                    'title' => count($toAssign) === 1
                        ? 'Task created and assigned to 1 member.'
                        : 'Task created and assigned to '.count($toAssign).' members.',
                ]);
            }
        }

        $this->reset(['name', 'description', 'taskCategoryId', 'maxScore', 'deadlineAt', 'assignUserSearch', 'selectedUserIds', 'selectedRoleIds']);
        $this->resetValidation();
    }

    /**
     * @param array<int, int> $userIds
     */
    private function sendAssignmentNotifications(array $userIds, ?string $deadlineDb): void
    {
        if ($userIds === []) {
            return;
        }

        $template = new Task;
        $template->name = $this->name;
        $template->deadline_at = $deadlineDb ? Carbon::parse($deadlineDb) : null;

        $messenger = app(TaskNotificationMessenger::class);
        $users = User::query()
            ->whereIn('id', $userIds)
            ->get(['id', 'name', 'first_name', 'mobile_no', 'email']);

        foreach ($users as $user) {
            $body = $messenger->assignmentMessage($user, $template);
            $messenger->notify($user, 'Task assigned: '.$template->name, $body);
        }
    }

    public function render()
    {
        $assignRoles = Role::query()->orderBy('sort_order')->orderBy('id')->get(['id', 'name']);

        return view('livewire.admin.task.create-task', compact('assignRoles'));
    }
}
