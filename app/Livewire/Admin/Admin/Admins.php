<?php

namespace App\Livewire\Admin\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Admins extends Component
{
    use WithPagination;

    public function render()
    {
        $adminUsers = User::query()
            ->where('is_admin', 1)
            ->orderByDesc('id')
            ->paginate(15);

        return view('livewire.admin.admin.admins', compact('adminUsers'));
    }

    public function delete($id)
    {
        $user = User::where('id', $id)->first();

        if (!isset($user) || !Auth::user()->is_admin) {
            abort(404);
        }

        $user->forceDelete();

        $this->dispatch('success_alert', ['title' => 'Admin User successfully Deleted.']);
        $this->resetPage();
    }
}
