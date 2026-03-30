<?php

namespace App\Livewire\Admin\Admin;

use App\Models\Permissions;
use App\Models\User;
use App\Models\UserHasPermissions;
use App\Services\UserService;
use App\Traits\UniqueIdTrait;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateAdmin extends Component
{
    use UniqueIdTrait;

    public $name, $password, $confirm_password;
    public $permissions;

    public function mount() {}

    public function render()
    {
        return view('livewire.admin.admin.create-admin');
    }

    public function addAdmin()
    {
        $this->validate([
            'name' => 'required|string|not_regex:/[@#$%^&*();><]/',
            'password' => 'required|min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required|min:6'
        ]);

        $user = new User();
        $user->name =  $this->name;
        $user->is_admin =  1;
        $user->email =  'admin@equest.com';
        $user->is_customer =  false;
        $user->password =  Hash::make($this->password);
        $user->save();

        $user->unique_id = $this->getUniqueIdForMainUser(id: $user->id);
        $user->reg_no = $this->getCustomId(id: $user->id);
        $user->type = User::MAIN;


        $user->save();

        $this->clearPasswords();

        // session()->flash('message', 'Admin User successfully Created.');
        return $this->dispatch('success_alert', ['title' => 'Admin User successfully Created.']);
    }

    public function clearPasswords()
    {
        $this->confirm_password = "";
        $this->password = "";
        $this->name = "";
    }
}
