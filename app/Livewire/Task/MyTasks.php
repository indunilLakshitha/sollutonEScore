<?php

namespace App\Livewire\Task;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MyTasks extends Component
{
    use WithPagination;

    /** Filter: '', 'pending', 'expired', 'completed', 'approved', 'rejected' */
    public string $filter = '';

    /** Optional note per task id when marking as done */
    public array $notes = [];

    public function updatingFilter(): void
    {
        $this->resetPage();
    }

    /**
     * Mark assignment as completed (Submitted) — admin sees these under Assignment Complete.
     */
    public function markAsDone(int $id): void
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

            $this->dispatch('success_alert', ['title' => 'Task expired.']);
            unset($this->notes[$id]);

            return;
        }

        if ($task->status !== Task::STATUS_ASSIGNED && $task->status !== Task::STATUS_REJECTED) {
            return;
        }

        $note = trim((string) ($this->notes[$id] ?? ''));

        $task->status = Task::STATUS_SUBMITTED;
        $task->submission_note = $note !== '' ? $note : null;
        $task->submitted_at = now();
        $task->save();

        unset($this->notes[$id]);

        $this->dispatch('success_alert', ['title' => 'Marked as done. It will appear in admin Assignment Complete for review.']);
    }

    public function render()
    {
        if (!Auth::check()) {
            abort(404);
        }

        $taskQuery = Task::query()
            ->with(['category:id,name'])
            ->where('assigned_user_id', Auth::id());

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

        $tasks = $taskQuery->orderByDesc('id')->paginate(15);

        return view('livewire.task.my-tasks', compact('tasks'));
    }
}
