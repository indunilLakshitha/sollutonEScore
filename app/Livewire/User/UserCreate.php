<?php

namespace App\Livewire\User;

use App\Models\User;
use App\Services\UserService;
use App\Traits\UniqueIdTrait;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserCreate extends Component
{
    use UniqueIdTrait;

    public   $email, $name, $id;
    public $isEdit = false;

    public function render()
    {
        return view('livewire.user.user-create');
    }

    public function save()
    {
        $this->validate();
        $mainUser = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make('123456789'),
        ]);

        $mainUser->unique_id = $this->getUniqueIdForMainUser(id: $mainUser->id);
        $mainUser->type = User::MAIN;

        (new UserService())->addLeftAccount(user: $mainUser);
        (new UserService())->addRightAccount(user: $mainUser);

        $mainUser->save();
        $this->clear();
    }

    public function clear()
    {
        $this->email = "";
        $this->name = "";
    }

    protected function rules()
    {
        return  [
            'name' => 'required',
            'email' => 'email',
        ];
    }

}
