<?php

namespace App\Livewire\Admin\Promotions;

use App\Models\Promotion;
use App\Models\PromotionHasCourse;
use App\Models\PromotionHasCriteria;
use App\Models\PromotionHasPromotion;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';

    public function filter()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $promotion = Promotion::findOrFail($id);
        PromotionHasCriteria::where('promotion_id', $id)->delete();
        PromotionHasCourse::where('promotion_id', $id)->delete();
        PromotionHasPromotion::where('promotion_id', $id)->delete();

        $promotion->delete();

        return $this->dispatch('success_alert', ['title' => 'Promotion deleted successfully.']);
    }

    public function render()
    {
        $promotions = Promotion::with(['addedBy', 'criteria', 'requiredPromotions'])
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('livewire.admin.promotions.index', compact('promotions'));
    }
}
