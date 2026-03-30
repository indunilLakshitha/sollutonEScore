<?php

namespace App\Livewire\Admin\TaskCategory;

use App\Models\TaskCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdateTaskCategory extends Component
{
    public int $id;
    public string $name = '';
    public bool $isActive = true;

    public function mount($id): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $cat = TaskCategory::query()->whereKey($id)->firstOrFail();
        $this->id = (int) $cat->id;
        $this->name = $cat->name;
        $this->isActive = (bool) $cat->is_active;
    }

    public function save(): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $this->validate([
            'name' => 'required|string|max:255|unique:task_categories,name,' . $this->id,
            'isActive' => 'required|boolean',
        ]);

        $cat = TaskCategory::query()->whereKey($this->id)->firstOrFail();
        $cat->name = $this->name;
        $cat->is_active = $this->isActive ? 1 : 0;
        $cat->save();

        $this->dispatch('success_alert', ['title' => 'Category updated.']);
    }

    public function render()
    {
        return view('livewire.admin.task-category.update-task-category');
    }
}

