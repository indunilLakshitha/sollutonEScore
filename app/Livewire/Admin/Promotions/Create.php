<?php

namespace App\Livewire\Admin\Promotions;

use App\Models\Promotion;
use App\Models\Criteria;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $image;
    public $sales_target = 0;
    public $sales_target_type = 1;
    public $income_target = 0;
    public $income_target_type = 1;
    public $status = true;
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
        // 'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'sales_target' => 'required|numeric|min:0',
        'sales_target_type' => 'required|in:1,2,3',
        'income_target' => 'required|numeric|min:0',
        'income_target_type' => 'required|in:1,2,3',
        'status' => 'boolean',
        'reward_name' => 'nullable|string|max:255',
        'direct_sale_count' => 'required|integer|min:0'
    ];

    public function save()
    {
        $this->validate();

        $imagePath = null;
        if ($this->image) {
            $filename = 'promotion_' . Str::random(12) . '.' . $this->image->getClientOriginalExtension();
            $imagePath = $this->image->storeAs('promotions', $filename, 'public');
        }

        $promotion = Promotion::create([
            'name' => $this->name,
            'image' => $imagePath,
            'sales_target' => $this->sales_target,
            'sales_target_type' => $this->sales_target_type,
            'income_target' => $this->income_target,
            'income_target_type' => $this->income_target_type,
            'reward_name' => $this->reward_name,
            'downline_count' => $this->has_downline_requirement ? 2 : 0,
            'direct_sale_count' => $this->direct_sale_count,
            'added_by' => Auth::id(),
            'status' => $this->status
        ]);

        // Attach selected criteria with required counts
        if (!empty($this->selected_criteria)) {
            $criteriaData = [];
            foreach ($this->selected_criteria as $criteriaId) {
                $requiredCount = $this->criteria_required_counts[$criteriaId] ?? 1;
                $criteriaData[$criteriaId] = [
                    'required_count' => $requiredCount,
                    'is_active' => true
                ];
            }
            $promotion->criteria()->attach($criteriaData);
        }

        // Attach selected required promotions with required counts
        if (!empty($this->selected_required_promotions)) {
            $promotionData = [];
            foreach ($this->selected_required_promotions as $promotionId) {
                $requiredCount = $this->required_promotion_counts[$promotionId] ?? 1;
                $promotionData[$promotionId] = [
                    'required_count' => $requiredCount,
                    'is_active' => true
                ];
            }
            $promotion->requiredPromotions()->attach($promotionData);
        }

        // Handle course assignments
        if (!empty($this->assigned_courses)) {
            $courseIds = array_map('intval', $this->assigned_courses);
            $this->promotion->courses()->attach($courseIds);
        }

        $this->dispatch('success_alert', ['title' => 'Promotion created successfully.']);
        return redirect()->route('admin.promotions.index');
    }

    public function render()
    {
        $criterias = Criteria::where('status', true)->get();
        $availablePromotions = Promotion::where('status', true)
            ->where('id', '!=', $this->promotion->id ?? 0)
            ->get();
        return view('livewire.admin.promotions.create', compact('criterias', 'availablePromotions'));
    }
}
