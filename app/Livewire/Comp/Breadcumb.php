<?php

namespace App\Livewire\Comp;

use Livewire\Component;

class Breadcumb extends Component
{
    public $title, $section, $sub, $action;

    public function mount(
        string $title,
        string $section,
        string $sub,
        string $action,
    ) {
        $this->title = $title;
        $this->section = $section;
        $this->sub = $sub;
        $this->action = $action;
    }
    public function render()
    {
        return view('livewire.comp.breadcumb');
    }
}
