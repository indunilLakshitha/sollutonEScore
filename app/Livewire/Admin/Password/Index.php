<?php

namespace App\Livewire\Admin\Password;

use App\Models\MasterData;
use Livewire\Component;

class Index extends Component
{
    public $masterRecords;

    public function mount()
    {
        $this->masterRecords = MasterData::all();
    }
    public function render()
    {
        return view('livewire.admin.password.index');
    }
}
