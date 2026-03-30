<?php

namespace App\Livewire\Admin\Member;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Members extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function toggleActive(int $id): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $user = User::query()->whereKey($id)->firstOrFail();
        $user->active_status = ((int) $user->active_status === User::BLOCKED) ? User::UNBLOCKED : User::BLOCKED;
        $user->save();

        $this->dispatch('success_alert', ['title' => 'Member status updated.']);
    }

    public function delete(int $id): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $user = User::query()->whereKey($id)->firstOrFail();
        $user->delete();

        $this->dispatch('success_alert', ['title' => 'Member deleted.']);
    }

    public function render()
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $members = User::query()
            ->with(['role:id,name'])
            ->when($this->search !== '', function ($q) {
                $s = trim($this->search);
                $q->where(function ($qq) use ($s) {
                    $qq->where('name', 'like', "%{$s}%")
                        ->orWhere('reg_no', 'like', "%{$s}%")
                        ->orWhere('unique_id', 'like', "%{$s}%")
                        ->orWhere('mobile_no', 'like', "%{$s}%");
                });
            })
            ->orderByDesc('id')
            ->paginate(15);

        return view('livewire.admin.member.members', compact('members'));
    }
}

