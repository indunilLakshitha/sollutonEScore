<?php

namespace App\Livewire\Admin\Password;

use App\Models\MasterData;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Edit extends Component
{
    public $id;
    public $masterData, $password, $confirm_password;

    public function mount($id)
    {
        $this->id = $id;

        $masterData = MasterData::where('id', $id)->first();

        if (!isset($masterData) || !Auth::user()->is_admin)
            abort(404);

        $this->masterData = $masterData;
    }

    public function updateComissionPassword()
    {
        $this->validate([
            'password' => 'required|min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required|min:6'
        ]);

        $masterData = $this->masterData;
        $masterData->comission_password =  Hash::make($this->password);
        $masterData->save();

        $this->clearPasswords();

        return $this->dispatch('success_alert', ['title' => 'Comission Password successfully Updated.']);
    }

    public function clearPasswords()
    {
        $this->confirm_password = "";
        $this->password = "";
    }
    public function render()
    {
        return view('livewire.admin.password.edit');
    }
}
