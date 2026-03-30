<?php

namespace App\Traits;

use App\Models\Promotion;
use App\Models\PromotionHistory;
use App\Models\User;
use Carbon\Carbon;

trait RankingTrait
{
    public function isTwoDownlinePassed(): bool
    {

        if (
            $this->user->my_left_a1_active && $this->user->my_left_a2_active &&
            $this->user->my_right_a1_active && $this->user->my_right_a2_active
        ) {
            return true;
        } else {
            return false;
        }
    }

    public function getSalesTarget(Promotion $promotion, string $userId): int
    {

        // if ($promotion->sales_target_type == Promotion::SALES_TARGET_TYPES['MONTHLY']) {
        // $sales = $this->getSalesForMonth(userId: $userId,  month: $month);
        // } else if ($promotion->sales_target_type == Promotion::SALES_TARGET_TYPES['YEARLY']) {
        // $sales = $this->getSalesForYear(userId: $userId,  year: $year);
        // } else if ($promotion->sales_target_type == Promotion::SALES_TARGET_TYPES['ALL']) {
        $sales = $this->getSalesForAllTime(userId: $userId);
        // }

        return $sales ?? 0;
    }

    public function getIncomeTarget(Promotion $promotion, string $userId): int
    {

        // if ($promotion->income_target_type == Promotion::SALES_TARGET_TYPES['MONTHLY']) {
        // $income = $this->getIncomeForMonth(userId: $userId,  month: $month);
        // } else if ($promotion->income_target_type == Promotion::SALES_TARGET_TYPES['YEARLY']) {
        // $income = $this->getIncomeForYear(userId: $userId,  year: $year);
        // } else if ($promotion->income_target_type == Promotion::SALES_TARGET_TYPES['ALL']) {
        $income = $this->getIncomeForAllTime(userId: $userId);
        // }
        return $income?->total_earnings ?? 0;
    }

    public function getMyTeam(string $userId): array
    {
        $user = User::where('id', $userId)->first();

        $myCode = 'P' . $user->unique_id;
        $left =  User::where('approved_by_admin', true)
            ->where('path', 'like', '%' .   $myCode . 'SL' . '%')
            ->where('type',  User::MAIN)
            ->pluck('id')->toArray() ?? [];

        $right =  User::where('approved_by_admin', true)
            ->where('path', 'like', '%' .  $myCode . 'SR'  . '%')
            ->where('type',  User::MAIN)
            ->pluck('id')->toArray() ?? [];

        return [
            'left' => $left,
            'right' => $right
        ];
    }

    public function addToAchivedHistory(Promotion $promotion, string $userId): PromotionHistory
    {
        $history = PromotionHistory::where('promotion_id', $promotion->id)
            ->where('user_id', $userId)->first();
        if (!isset($history)) {

            $history =  PromotionHistory::create([
                'promotion_id' => $promotion->id,
                'user_id' => $userId,
                'achived_at' => Carbon::now(),
            ]);
        }
        return $history;
    }

    public function getOngoingPromotion() {}
}
