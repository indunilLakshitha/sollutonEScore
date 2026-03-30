<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;

class UserList extends Component
{

    public  $users;

    public function mount()
    {
        $this->users = User::all();
    }

    public function render()
    {
        return view('livewire.user.user-list');
    }

    public function edit($id)
    {
        return redirect()->route('user.edit', ['id' => $id]);
    }
}
