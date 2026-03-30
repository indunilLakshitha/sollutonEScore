<?php

namespace App\Livewire\Admin\TaskCategory;

use App\Models\TaskCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class TaskCategories extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function toggleActive(int $id): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $cat = TaskCategory::query()->whereKey($id)->firstOrFail();
        $cat->is_active = !$cat->is_active;
        $cat->save();

        $this->dispatch('success_alert', ['title' => 'Category status updated.']);
    }

    public function delete(int $id): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $cat = TaskCategory::query()->whereKey($id)->firstOrFail();
        $cat->delete();

        $this->dispatch('success_alert', ['title' => 'Category deleted.']);
    }

    public function render()
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $categories = TaskCategory::query()
            ->when($this->search !== '', fn ($q) => $q->where('name', 'like', '%' . trim($this->search) . '%'))
            ->orderBy('name')
            ->paginate(15);

        return view('livewire.admin.task-category.task-categories', compact('categories'));
    }
}

