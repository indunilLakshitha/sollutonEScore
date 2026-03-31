<?php

namespace App\Livewire\Task;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MyTasks extends Component
{
    use WithPagination;

    /** Filter: '', 'pending', 'expired', 'completed', 'approved', 'rejected' */
    public string $filter = '';
    public string $search = '';
    public ?string $filterCreatedDay = null;
    public ?string $filterCreatedMonth = null;
    public ?string $filterCreatedFrom = null;
    public ?string $filterCreatedTo = null;

    /** Optional note per task id when marking as done */
    public array $notes = [];

    public function openTaskPopup(int $id): void
    {
        if (!Auth::check()) {
            abort(404);
        }

        $task = Task::query()
            ->with(['category:id,name'])
            ->whereKey($id)
            ->where('assigned_user_id', Auth::id())
            ->firstOrFail();

        $group = Task::query()
            ->forSameDefinitionAs($task)
            ->whereNotNull('assigned_user_id')
            ->with(['assignedUser:id,name,reg_no'])
            ->get(['id', 'assigned_user_id']);

        $otherUsers = $group
            ->filter(fn (Task $t): bool => (int) $t->assigned_user_id !== (int) Auth::id())
            ->map(function (Task $t): array {
                return [
                    'id' => (int) $t->assigned_user_id,
                    'name' => (string) ($t->assignedUser?->name ?? ''),
                    'reg_no' => (string) ($t->assignedUser?->reg_no ?? ''),
                ];
            })
            ->values()
            ->all();

        $this->dispatch('task_details_popup', [
            'task' => [
                'id' => (int) $task->id,
                'name' => (string) $task->name,
                'description' => (string) ($task->description ?? ''),
                'category' => (string) ($task->category?->name ?? ''),
                'status' => (string) $task->status,
                'is_expired' => (bool) $task->is_expired,
                'max_score' => (float) ($task->max_score ?? 0),
                'score' => $task->score !== null ? (float) $task->score : null,
                'deadline_at' => $task->deadline_at ? $task->deadline_at->format('Y-m-d H:i') : null,
                'submission_note' => (string) ($task->submission_note ?? ''),
                'submitted_at' => $task->submitted_at ? $task->submitted_at->format('Y-m-d H:i') : null,
            ],
            'other_users' => $otherUsers,
            'can_submit' => in_array($task->status, [Task::STATUS_ASSIGNED, Task::STATUS_REJECTED], true) && !$task->is_expired,
        ]);
    }

    public function markAsDoneWithNote(int $id, ?string $note = null): void
    {
        $this->notes[$id] = $note;
        $saved = $this->markAsDone($id, false);
        if ($saved) {
            $this->dispatch('success_alert', ['title' => 'Task saved.']);
        }
    }

    protected $listeners = [
        'markAsDoneWithNote' => 'markAsDoneWithNote',
    ];

    public function updatingFilter(): void
    {
        $this->resetPage();
    }

    public function updatingSearch(): void
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
     * Mark assignment as completed (Submitted) — admin sees these under Assignment Complete.
     */
    public function markAsDone(int $id, bool $withAlert = true): bool
    {
        if (!Auth::check()) {
            abort(404);
        }

        $task = Task::query()
            ->whereKey($id)
            ->where('assigned_user_id', Auth::id())
            ->firstOrFail();

        if ($task->is_expired) {
            $task->status = Task::STATUS_REJECTED;
            $task->rejected_at = now();
            $task->score = 0;
            $task->save();

            if ($withAlert) {
                $this->dispatch('success_alert', ['title' => 'Task expired.']);
            }
            unset($this->notes[$id]);

            return true;
        }

        if ($task->status !== Task::STATUS_ASSIGNED && $task->status !== Task::STATUS_REJECTED) {
            return false;
        }

        $note = trim((string) ($this->notes[$id] ?? ''));

        $task->status = Task::STATUS_SUBMITTED;
        $task->submission_note = $note !== '' ? $note : null;
        $task->submitted_at = now();
        $task->save();

        unset($this->notes[$id]);

        if ($withAlert) {
            $this->dispatch('success_alert', ['title' => 'Marked as done. It will appear in admin Assignment Complete for review.']);
        }

        return true;
    }

    public function render()
    {
        if (!Auth::check()) {
            abort(404);
        }

        $taskQuery = Task::query()
            ->with(['category:id,name'])
            ->where('assigned_user_id', Auth::id());

        $s = trim($this->search);
        if ($s !== '') {
            $taskQuery->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                    ->orWhereHas('category', function ($c) use ($s) {
                        $c->where('name', 'like', "%{$s}%");
                    });
            });
        }

        if ($this->filterCreatedDay) {
            $taskQuery->whereDate('created_at', $this->filterCreatedDay);
        } elseif ($this->filterCreatedMonth) {
            $parts = explode('-', $this->filterCreatedMonth);
            $mYear = isset($parts[0]) ? (int) $parts[0] : 0;
            $mMonth = isset($parts[1]) ? (int) $parts[1] : 0;
            if ($mYear > 0 && $mMonth >= 1 && $mMonth <= 12) {
                $taskQuery->whereYear('created_at', $mYear)
                    ->whereMonth('created_at', $mMonth);
            }
        } else {
            if ($this->filterCreatedFrom) {
                $taskQuery->whereDate('created_at', '>=', $this->filterCreatedFrom);
            }
            if ($this->filterCreatedTo) {
                $taskQuery->whereDate('created_at', '<=', $this->filterCreatedTo);
            }
        }

        match ($this->filter) {
            'pending' => $taskQuery->whereIn('status', [Task::STATUS_ASSIGNED, Task::STATUS_REJECTED]),
            'expired' => $taskQuery->whereNotNull('deadline_at')
                ->where('deadline_at', '<', now())
                ->whereNotIn('status', [Task::STATUS_APPROVED]),
            'completed' => $taskQuery->where('status', Task::STATUS_SUBMITTED),
            'approved' => $taskQuery->where('status', Task::STATUS_APPROVED),
            'rejected' => $taskQuery->where('status', Task::STATUS_REJECTED),
            default => null,
        };

        // Show "not done" first (Assigned/Rejected), then the rest; within each group show latest first.
        $tasks = $taskQuery
            ->orderByRaw(
                'CASE WHEN status IN (?, ?) THEN 0 ELSE 1 END',
                [Task::STATUS_ASSIGNED, Task::STATUS_REJECTED]
            )
            ->orderByDesc('id')
            ->paginate(15);

        return view('livewire.task.my-tasks', compact('tasks'));
    }
}
