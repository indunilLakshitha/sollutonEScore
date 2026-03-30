<?php

namespace App\Livewire\Admin\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Admins extends Component
{
    public $adminUsers;

    public function mount()
    {
        $this->adminUsers = User::where('is_admin', 1)->get();
    }

    public function render()
    {
        return view('livewire.admin.admin.admins');
    }

    public function delete($id)
    {
        $user = User::where('id', $id)->first();

        if (!isset($user) || !Auth::user()->is_admin)
            abort(404);

        $user->forceDelete();

        // session()->flash('message', 'Admin User successfully Deleted.');
        $this->dispatch('success_alert', ['title' => 'Admin User successfully Deleted.']);
        $this->mount();
    }
}
