<?php

namespace App\Services;

use App\Models\CompanyMonthlySale;
use App\Models\IncomeSalesMultiplier;
use App\Models\Role;
use App\Models\User;
use App\Models\UserMonthlySalary;
use App\Models\UserPerformance;
use App\Models\UserSalesIncome;

class ManagementIncomeService
{
    public function syncForMonth(int $year, int $month): void
    {
        $managementRoleId = Role::query()
            ->where('slug', Role::SLUG_MANAGEMENT)
            ->value('id');

        $managementUsers = User::query()
            ->when($managementRoleId, fn ($q) => $q->where('role_id', $managementRoleId), fn ($q) => $q->whereRaw('1 = 0'))
            ->get(['id']);

        $managementUserIds = $managementUsers
            ->pluck('id')
            ->map(fn ($id) => (int) $id)
            ->all();

        $totalManagementMembers = count($managementUserIds);

        $companySalesCount = (int) CompanyMonthlySale::query()
            ->where('year', $year)
            ->where('month', $month)
            ->value('sales_count');
        $coeff = IncomeSalesMultiplier::query()->first();
        $managementMultiplier = (float) ($coeff->management_multiplier ?? 1000);
        $directorMultiplier = (float) ($coeff->director_multiplier ?? 4000);

        $managementSalesBase = $companySalesCount * $managementMultiplier;
        $directorSalesBase = $companySalesCount * $directorMultiplier;

        $baseShare = $totalManagementMembers > 0
            ? ($managementSalesBase) / $totalManagementMembers
            : 0.0;
        $directorRoleId = Role::query()
            ->where('slug', Role::SLUG_DIRECTOR)
            ->value('id');
        $leaderRoleId = Role::query()
            ->where('slug', Role::SLUG_LEADER)
            ->value('id');

        $directorUsers = User::query()
            ->when($directorRoleId, fn ($q) => $q->where('role_id', $directorRoleId), fn ($q) => $q->whereRaw('1 = 0'))
            ->get(['id', 'share_amount']);

        $directorUserIds = $directorUsers
            ->pluck('id')
            ->map(fn ($id) => (int) $id)
            ->all();

        $leaderUsers = User::query()
            ->when($leaderRoleId, fn ($q) => $q->where('role_id', $leaderRoleId), fn ($q) => $q->whereRaw('1 = 0'))
            ->get(['id']);

        $leaderUserIds = $leaderUsers
            ->pluck('id')
            ->map(fn ($id) => (int) $id)
            ->all();

        $targetUserIds = array_values(array_unique(array_merge($managementUserIds, $directorUserIds, $leaderUserIds)));

        $performanceByUser = UserPerformance::query()
            ->where('year', $year)
            ->where('month', $month)
            ->whereIn('user_id', $targetUserIds)
            ->pluck('performance', 'user_id');

        foreach ($managementUserIds as $userId) {
            $performance = (float) ($performanceByUser[$userId] ?? 0);
            $income = round(($performance / 100) * $baseShare, 2);

            UserSalesIncome::query()->updateOrCreate(
                [
                    'user_id' => $userId,
                    'year' => $year,
                    'month' => $month,
                ],
                [
                    'income_amount' => $income,
                ]
            );
        }

        foreach ($directorUsers as $director) {
            $shareAmount = (float) ($director->share_amount ?? 0);
            $performance = (float) ($performanceByUser[(int) $director->id] ?? 0);

            // Director formula: (base / 100) * share * (performance / 100); base = sales_count * director_multiplier
            $income = $shareAmount > 0
                ? round(($directorSalesBase / 100) * $shareAmount * ($performance / 100), 2)
                : 0.0;

            UserSalesIncome::query()->updateOrCreate(
                [
                    'user_id' => (int) $director->id,
                    'year' => $year,
                    'month' => $month,
                ],
                [
                    'income_amount' => $income,
                ]
            );
        }

        $leaderSalaryByUser = UserMonthlySalary::query()
            ->where('year', $year)
            ->where('month', $month)
            ->whereIn('user_id', $leaderUserIds)
            ->pluck('amount', 'user_id');

        foreach ($leaderUserIds as $leaderUserId) {
            $performance = (float) ($performanceByUser[$leaderUserId] ?? 0);
            $monthlySalary = (float) ($leaderSalaryByUser[$leaderUserId] ?? 0);

            // Leader formula:
            // income = monthly salary (from user_monthly_salaries) * performance
            $income = round($monthlySalary * ($performance / 100), 2);

            UserSalesIncome::query()->updateOrCreate(
                [
                    'user_id' => $leaderUserId,
                    'year' => $year,
                    'month' => $month,
                ],
                [
                    'income_amount' => $income,
                ]
            );
        }
    }
}
