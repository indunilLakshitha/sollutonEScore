<?php

namespace App\Livewire\Task;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TaskDetails extends Component
{
    public int $id;

    public function mount(int $id): void
    {
        if (!Auth::check()) {
            abort(404);
        }

        $this->id = $id;
    }

    public function render()
    {
        if (!Auth::check()) {
            abort(404);
        }

        $task = Task::query()
            ->with(['category:id,name'])
            ->whereKey($this->id)
            ->firstOrFail();

        // Allow admins to view any task; non-admins only their assigned tasks.
        if (!Auth::user()?->is_admin && (int) $task->assigned_user_id !== (int) Auth::id()) {
            abort(404);
        }

        return view('livewire.task.task-details', compact('task'));
    }
}

