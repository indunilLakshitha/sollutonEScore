<?php

namespace App\Livewire\Admin\TaskCategory;

use App\Models\TaskCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateTaskCategory extends Component
{
    public string $name = '';
    public bool $isActive = true;

    public function mount(): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }
    }

    public function save(): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $this->validate([
            'name' => 'required|string|max:255|unique:task_categories,name',
            'isActive' => 'required|boolean',
        ]);

        TaskCategory::query()->create([
            'name' => $this->name,
            'is_active' => $this->isActive ? 1 : 0,
        ]);

        $this->reset(['name', 'isActive']);
        $this->resetValidation();
        $this->dispatch('success_alert', ['title' => 'Category created.']);
    }

    public function render()
    {
        return view('livewire.admin.task-category.create-task-category');
    }
}

