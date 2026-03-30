<?php

namespace App\Traits;

use App\Models\Promotion;
use App\Models\PromotionHistory;
use App\Traits\SalesTrait;
use App\Models\User;
use Carbon\Carbon;
use Dotenv\Util\Str;
use Illuminate\Database\Eloquent\Collection;

trait PromotionTrait
{

    use SalesTrait;

    /**
     * Get ongoing (active) promotions for a specific user
     *
     * @param User|int $user User instance or user ID
     * @return Collection
     */
    public function getOngoingPromotionForUser($userId)
    {

        $salesCount = $this->getUserEarnings($userId);

        $ongoing =  Promotion::where('status', true)
            ->where(function ($query) use ($salesCount) {
                $query->orWhere('sales_target', '>', (int)$salesCount['sales_count'])
                    ->orWhere('income_target', '>', (int)$salesCount['total_earnings']);
            })

            ->orderBy('sales_target', 'asc')
            ->first();

        return [
            'ongoing' => $ongoing,
            'sales_count' => $salesCount['sales_count'],
            'total_earnings' => $salesCount['total_earnings']
        ];
    }

    public function getAchievedgPromotionsForUser($userId)
    {

        return PromotionHistory::with('promotion')->where('user_id', $userId)->get() ?? [];
        // $salesCount = $this->getUserEarnings($userId);
        // return Promotion::where('status', true)
        //     ->where('sales_target', '<', (int)$salesCount['sales_count'])
        //     ->where('income_target', '<', (int)$salesCount['total_earnings'])
        //     ->orderBy('sales_target', 'asc')
        //     ->get() ?? [];
    }

    public function getAcievedPromotionsForUser(string $userId, ?string $month, ?string $year)
    {
        $promotions = Promotion::all();
        foreach ($promotions as $promotion) {

            if ($promotion->income_target_type == Promotion::SALES_TARGET_TYPES['MONTHLY']) {
                $income = $this->getIncomeForMonth(userId: $userId,  month: $month);
            } else if ($promotion->income_target_type == Promotion::SALES_TARGET_TYPES['YEARLY']) {
                $income = $this->getIncomeForYear(userId: $userId,  year: $year);
            } else if ($promotion->income_target_type == Promotion::SALES_TARGET_TYPES['ALL']) {
                $income = $this->getIncomeForAllTime(userId: $userId);
            }

            if ($promotion->sales_target_type == Promotion::SALES_TARGET_TYPES['MONTHLY']) {
                $sales = $this->getSalesForMonth(userId: $userId,  month: $month);
            } else if ($promotion->sales_target_type == Promotion::SALES_TARGET_TYPES['YEARLY']) {
                $sales = $this->getSalesForYear(userId: $userId,  year: $year);
            } else if ($promotion->sales_target_type == Promotion::SALES_TARGET_TYPES['ALL']) {
                $sales = $this->getSalesForAllTime(userId: $userId);
            }
        }
    }
}
