<?php

namespace App\Livewire\Admin\Promotions;

use App\Models\Promotion;
use App\Models\Criteria;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Edit extends Component
{
    use WithFileUploads;

    public $promotion;
    public $name;
    public $image; // uploaded temp file
    public $current_image; // path string
    public $sales_target;
    public $sales_target_type;
    public $income_target;
    public $income_target_type;
    public $status;
    public $selected_criteria = [];
    public $criteria_required_counts = [];
    public $assigned_courses = [];
    public $selected_required_promotions = [];
    public $required_promotion_counts = [];
    public $reward_name = '';
    public $has_downline_requirement = false;
    public $direct_sale_count = 0;

    protected $rules = [
        'name' => 'required|string|max:255',
        // 'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|dimensions:width=1280,height=1280|max:2048',
        'sales_target' => 'required|numeric|min:0',
        'sales_target_type' => 'required|in:1,2,3',
        'income_target' => 'required|numeric|min:0',
        'income_target_type' => 'required|in:1,2,3',
        'status' => 'boolean',
        'reward_name' => 'nullable|string|max:255',
        'direct_sale_count' => 'required|integer|min:0'
    ];

    public function mount($id)
    {
        $this->promotion = Promotion::findOrFail($id);
        $this->name = $this->promotion->name;
        $this->current_image = $this->promotion->image;
        $this->sales_target = $this->promotion->sales_target;
        $this->sales_target_type = $this->promotion->sales_target_type;
        $this->income_target = $this->promotion->income_target;
        $this->income_target_type = $this->promotion->income_target_type;
        $this->status = $this->promotion->status;
        $this->reward_name = $this->promotion->reward_name;
        $this->has_downline_requirement = $this->promotion->downline_count > 0;
        $this->direct_sale_count = $this->promotion->direct_sale_count;

        // Load existing criteria assignments
        $this->selected_criteria = $this->promotion->criteria->pluck('id')->toArray();
        foreach ($this->promotion->criteria as $criteria) {
            $this->criteria_required_counts[$criteria->id] = $criteria->pivot->required_count;
        }

        // Load existing required promotion assignments
        $this->selected_required_promotions = $this->promotion->requiredPromotions->pluck('id')->toArray();
        foreach ($this->promotion->requiredPromotions as $requiredPromotion) {
            $this->required_promotion_counts[$requiredPromotion->id] = $requiredPromotion->pivot->required_count;
        }

        // Initialize assigned courses (if any)
        $this->assigned_courses = $this->promotion->courses->pluck('id')->toArray();
    }

    public function update()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'sales_target' => $this->sales_target,
            'sales_target_type' => $this->sales_target_type,
            'income_target' => $this->income_target,
            'income_target_type' => $this->income_target_type,
            'reward_name' => $this->reward_name,
            'downline_count' => $this->has_downline_requirement ? 2 : 0,
            'direct_sale_count' => $this->direct_sale_count,
            'status' => $this->status
        ];

        if ($this->image) {
            $filename = 'promotion_' . Str::random(12) . '.' . $this->image->getClientOriginalExtension();
            $path = $this->image->storeAs('promotions', $filename, 'public');
            // remove old if exists
            if ($this->current_image && Storage::disk('public')->exists($this->current_image)) {
                Storage::disk('public')->delete($this->current_image);
            }
            $data['image'] = $path;
            $this->current_image = $path;
        }

        $this->promotion->update($data);

        // Sync criteria assignments
        if (!empty($this->selected_criteria)) {
            $criteriaData = [];
            foreach ($this->selected_criteria as $criteriaId) {
                $requiredCount = $this->criteria_required_counts[$criteriaId] ?? 1;
                $criteriaData[$criteriaId] = [
                    'required_count' => $requiredCount,
                    'is_active' => true
                ];
            }
            $this->promotion->criteria()->sync($criteriaData);
        } else {
            $this->promotion->criteria()->detach();
        }

        // Sync required promotion assignments
        if (!empty($this->selected_required_promotions)) {
            $promotionData = [];
            foreach ($this->selected_required_promotions as $promotionId) {
                $requiredCount = $this->required_promotion_counts[$promotionId] ?? 1;
                $promotionData[$promotionId] = [
                    'required_count' => $requiredCount,
                    'is_active' => true
                ];
            }
            $this->promotion->requiredPromotions()->sync($promotionData);
        } else {
            $this->promotion->requiredPromotions()->detach();
        }

        // Handle course assignments
        if (!empty($this->assigned_courses)) {
            $courseIds = array_map('intval', $this->assigned_courses);
            $this->promotion->courses()->sync($courseIds);
        } else {
            $this->promotion->courses()->detach();
        }

        $this->dispatch('success_alert', ['title' => 'Promotion updated successfully.']);
        return redirect()->route('admin.promotions.index');
    }

    public function render()
    {
        $criterias = Criteria::where('status', true)->get();
        $availablePromotions = Promotion::where('status', true)
            ->where('id', '!=', $this->promotion->id)
            ->get();
        return view('livewire.admin.promotions.edit', compact('criterias', 'availablePromotions'));
    }
}
