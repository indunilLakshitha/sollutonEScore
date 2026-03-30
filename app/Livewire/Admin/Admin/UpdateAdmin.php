<?php

namespace App\Livewire\Admin\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UpdateAdmin extends Component
{


    public $id;
    public $user, $name, $password, $confirm_password;

    public function mount($id)
    {
        $this->id = $id;

        $user = User::where('id', $id)->first();

        if (!isset($user) || !Auth::user()->is_admin)
            abort(404);

        $this->user = $user;
        $this->name = $user->name;
    }

    public function render()
    {
        return view('livewire.admin.admin.update-admin');
    }

    public function updateAdmin()
    {

        $this->validate([
            'name' => 'required',
            'password' => 'required|min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required|min:6'
        ]);
        $user = User::where('id', $this->id)->first();
        $user->name =  $this->name;
        $user->password =  Hash::make($this->password);
        $user->save();

        $this->clearPasswords();

        // return session()->flash('message', 'Admin User successfully Updated.');
        return $this->dispatch('success_alert', ['title' => 'Admin User successfully Updated.']);
    }

    public function clearPasswords()
    {
        $this->confirm_password = "";
        $this->password = "";
        $this->name = "";
    }
}
