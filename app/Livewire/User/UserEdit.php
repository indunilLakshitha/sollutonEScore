<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class UserEdit extends Component
{

    public   $email, $name, $id;

    public function mount($id)
    {
        $user = User::where('id', $id)->first();
        $this->email = $user->email;
        $this->name = $user->name;
        $this->id = $user->id;
    }

    protected function rules()
    {
        return  [
            'name' => 'required',
            'email' => 'email',
        ];
    }

    public function edit()
    {
        if (!isset($this->email) || !isset($this->name))
            return;

        $user = User::where('id', $this->id)->first();
        $user->email = $this->email;
        $user->name = $this->name;
        $user->save();
    }

    public function render()
    {
        return view('livewire.user.user-edit');
    }
}
