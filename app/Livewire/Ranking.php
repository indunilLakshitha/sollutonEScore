<?php

namespace App\Livewire;

use App\Models\CriteriaUserAssignment;
use App\Models\Promotion;
use App\Models\PromotionHasCriteria;
use App\Models\PromotionHasPromotion;
use App\Models\PromotionHistory;
use App\Traits\RankingTrait;
use App\Traits\SalesTrait;
use App\Usecases\Ranking\RankingUsecase;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;


class Ranking extends Component
{
    use WithPagination, SalesTrait, RankingTrait;

    public $user;

    public $selected_promotion = '';
    public $rankings = [];
    public $current_rank;
    public $promotion_history = [];
    public $promotions = [];
    public $achivedIdList = [];
    public $oldDirectSaleTotal = 0;
    public $inProgress;
    public $inProgressInDetail, $promotionAssigned, $criteriaAssigned, $downline_status, $courseAssigned;

    public function mount()
    {
        $this->user = Auth::user();
        $result = (new RankingUsecase())->handle(userId: $this->user->id);
        $this->promotions =  $result['promotions'];
        $this->achivedIdList = $result['achivedIdList'];
        $this->inProgressInDetail = $result['inProgressInDetail'];
        $this->criteriaAssigned = $result['criteriaAssigned'];
        $this->promotionAssigned = $result['promotionAssigned'];
        $this->downline_status = $result['downline_status'];
        $this->courseAssigned = $result['courseAssigned'];
    }

    public function render()
    {


        return view('livewire.ranking', [
            'inProgressInDetail' => $this->inProgressInDetail,
            'criteriaAssigned' => $this->criteriaAssigned,
            'promotionAssigned' => $this->promotionAssigned,
            'downline_status' => $this->downline_status,
            'courseAssigned' => $this->courseAssigned,
        ]);
    }
}
