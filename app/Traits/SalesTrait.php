<?php

namespace App\Traits;

use App\Enums\TargetType;
use App\Models\Order;
use App\Models\User;
use App\Models\WalletHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

trait SalesTrait
{

    public static $allowedComissionTypes = [
        WalletHistory::COMISSION_TYPES['DIRECT'],
        WalletHistory::COMISSION_TYPES['GSC'],
        WalletHistory::COMISSION_TYPES['MARKETPLACE_PURCHASE'],
        WalletHistory::COMISSION_TYPES['DUMMY_TRANSFERED']
    ];

    public $allowedTypes = [WalletHistory::TYPE['ADDED']];

    public function getUserEarnings($userId)
    {
        $commonQuery = WalletHistory::where('user_id', $userId)
            ->where('type', WalletHistory::TYPE['ADDED'])
            ->whereIn('comission_type', self::$allowedComissionTypes)
            ->whereHas('user', function ($query) {
                $query->where('type', User::USER_TYPE['MAIN']);
            })
            ->with(['user' => function ($query) {
                $query->withCount(['approvedReferrals as approved_referrals_count']);
            }])

            ->select(DB::raw('SUM(amount) as total_earnings'), 'user_id', 'id', 'comission_type', 'type')
            ->first();

        return [
            'sales_count' => $commonQuery->user->approved_referrals_count ?? 0,
            'total_earnings' => $commonQuery->total_earnings ?? 0
        ];
    }

    private static function getCommonQueryForIncome(string $userId)
    {
        return WalletHistory::where('user_id', $userId)
            ->where('type', WalletHistory::TYPE['ADDED'])
            ->whereIn('comission_type', self::$allowedComissionTypes)
            ->whereHas('user', function ($query) {
                $query->where('type', User::USER_TYPE['MAIN']);
            })
            ->select(DB::raw('SUM(amount) as total_earnings'), 'user_id', 'id', 'comission_type', 'type');
    }

    /**
     * GET TOTAL EARNINS OF A USER FOR GIVEN MONTH
     */
    public function getIncomeForMonth(string $userId, string $month)
    {
        $startDate = Carbon::createFromFormat('F d Y', $month . ' 02 ' . date('Y'))->toDateString();
        $endDate = Carbon::parse($$month)->copy()->addMonth()->startOfMonth()->toDateString();

        return  self::getCommonQueryForIncome($userId)
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->first();
    }

    /**
     * GET TOTAL EARNINS OF A USER FOR GIVEN YEAR
     */
    public function getIncomeForYear(string $userId, string $year)
    {
        $startDate = Carbon::create($year, 1, 2)->toDateString();
        $endDate = Carbon::create($year + 1, 1, 1)->toDateString();

        return  self::getCommonQueryForIncome($userId)
            ->whereDate('created_at', '>=', $startDate)
            ->whereDate('created_at', '<=', $endDate)
            ->first();
    }

    /**
     * GET TOTAL EARNINS OF A USER FOR ALL AVAILABLE
     */
    public function getIncomeForAllTime(string $userId)
    {
        return  self::getCommonQueryForIncome($userId)->first();
    }

    private static function getCommonQueryForSales(string $userId)
    {
        return User::where('users.approved_by_admin', true)
            ->where('users.approved_by_referrer', true)
            ->where('users.type', User::USER_TYPE['MAIN'])
            ->where('users.status', '>=', 2)
            ->where('users.referrer_id', $userId);
    }

    /**
     * GET TOTAL SALES OF A USER FOR GIVEN MONTH
     */
    public function getSalesForMonth(string $userId, string $month)
    {
        $startDate = Carbon::createFromFormat('F d Y', $month . ' 02 ' . date('Y'))->toDateString();
        $endDate = Carbon::parse($$month)->copy()->addMonth()->startOfMonth()->toDateString();

        return  self::getCommonQueryForSales($userId)
            ->whereDate('approved_at', '>=', $startDate)
            ->whereDate('approved_at', '<=', $endDate)
            ->count();
    }

    /**
     * GET TOTAL SALES OF A USER FOR GIVEN YEAR
     */
    public function getSalesForYear(string $userId, string $year)
    {
        $startDate = Carbon::create($year, 1, 2)->toDateString();
        $endDate = Carbon::create($year + 1, 1, 1)->toDateString();

        return  self::getCommonQueryForSales($userId)
            ->whereDate('approved_at', '>=', $startDate)
            ->whereDate('approved_at', '<=', $endDate)
            ->count();
    }

    /**
     * GET TOTAL SALES OF A USER FOR ALL AVAILABLE
     */
    public function getSalesForAllTime(string $userId)
    {
        return  self::getCommonQueryForSales($userId)->count();
    }

    public function getDirectSales(string $userId)
    {
        return User::where('referrer_id', $userId)->get()->count();
    }
}
