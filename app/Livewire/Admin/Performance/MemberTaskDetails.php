<?php

namespace App\Livewire\Admin\Performance;

use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MemberTaskDetails extends Component
{
    use WithPagination;

    public int $memberId;
    public int $year = 0;
    public int $month = 0;
    public string $status = '';

    public function mount(int $id): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        User::query()->whereKey($id)->firstOrFail();
        $this->memberId = $id;
        $this->year = (int) now()->format('Y');
        $this->month = (int) now()->format('n');
    }

    public function updatedYear(): void
    {
        $this->resetPage();
    }

    public function updatedMonth(): void
    {
        $this->resetPage();
    }

    public function updatedStatus(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $member = User::query()->whereKey($this->memberId)->firstOrFail(['id', 'name', 'reg_no']);

        $tasks = Task::query()
            ->with(['category:id,name'])
            ->where('assigned_user_id', $this->memberId)
            ->whereYear('created_at', $this->year)
            ->whereMonth('created_at', $this->month)
            ->when($this->status !== '', fn ($q) => $q->where('status', $this->status))
            ->orderByDesc('id')
            ->paginate(15);

        return view('livewire.admin.performance.member-task-details', compact('member', 'tasks'));
    }
}
