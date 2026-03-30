<?php

namespace App\Livewire;

use App\Models\CompanyMonthlySale;
use App\Models\IncomeSalesMultiplier;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use App\Models\UserMonthlySalary;
use App\Models\UserSalesIncome;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $userId = (int) Auth::id();
        $now = now();
        $year = (int) $now->format('Y');
        $month = (int) $now->format('n');

        // Same task-based performance as Monthly Summary (not UserPerformance table).
        $assignedScoreByMonth = Task::query()
            ->where('assigned_user_id', $userId)
            ->whereYear('created_at', $year)
            ->selectRaw('MONTH(created_at) as m, COALESCE(SUM(max_score), 0) as total')
            ->groupBy('m')
            ->pluck('total', 'm')
            ->map(fn ($v) => (float) $v)
            ->all();

        $approvedScoreByMonth = Task::query()
            ->where('assigned_user_id', $userId)
            ->where('status', Task::STATUS_APPROVED)
            ->whereYear('approved_at', $year)
            ->selectRaw('MONTH(approved_at) as m, COALESCE(SUM(score), 0) as total')
            ->groupBy('m')
            ->pluck('total', 'm')
            ->map(fn ($v) => (float) $v)
            ->all();

        $monthlyLabels = [];
        $monthlyPerformances = [];
        for ($m = 1; $m <= 12; $m++) {
            $monthlyLabels[] = sprintf('%04d-%02d', $year, $m);
            $assignedScore = (float) ($assignedScoreByMonth[$m] ?? 0);
            $approvedScore = (float) ($approvedScoreByMonth[$m] ?? 0);
            $monthlyPerformances[] = $assignedScore > 0
                ? round(($approvedScore / $assignedScore) * 100, 2)
                : 0.0;
        }

        $currentAssignedTotal = (float) ($assignedScoreByMonth[$month] ?? 0);
        $currentApprovedTotal = (float) ($approvedScoreByMonth[$month] ?? 0);
        $currentPerformance = $currentAssignedTotal > 0
            ? round(($currentApprovedTotal / $currentAssignedTotal) * 100, 2)
            : 0.0;

        $companySalesCount = (int) (CompanyMonthlySale::query()
            ->where('year', $year)
            ->where('month', $month)
            ->value('sales_count') ?? 0);
        $coeff = IncomeSalesMultiplier::query()->first();
        $managementMultiplier = (float) ($coeff->management_multiplier ?? 1000);
        $directorMultiplier = (float) ($coeff->director_multiplier ?? 4000);

        $managementSalesBase = $companySalesCount * $managementMultiplier;
        $directorSalesBase = $companySalesCount * $directorMultiplier;

        $user = User::query()->whereKey($userId)->first();
        $managementRoleId = Role::query()->where('slug', Role::SLUG_MANAGEMENT)->value('id');
        $directorRoleId = Role::query()->where('slug', Role::SLUG_DIRECTOR)->value('id');
        $leaderRoleId = Role::query()->where('slug', Role::SLUG_LEADER)->value('id');

        $position = strtolower(trim((string) ($user?->position ?? '')));
        $isManagement = $user && (($managementRoleId && (int) $user->role_id === (int) $managementRoleId)
            || str_contains($position, 'management'));
        $isDirector = $user && (($directorRoleId && (int) $user->role_id === (int) $directorRoleId)
            || str_contains($position, 'director'));
        $isLeader = $user && (($leaderRoleId && (int) $user->role_id === (int) $leaderRoleId)
            || str_contains($position, 'leader'));

        $totalManagementMembers = ($user && $managementRoleId && (int) $user->role_id === (int) $managementRoleId)
            ? (int) User::query()->where('role_id', $managementRoleId)->count()
            : 0;

        // Original (full) vs actual income — same rules as Monthly Summary.
        $currentFullIncome = 0.0;
        $currentActualIncome = 0.0;

        if ($user && $isManagement) {
            $baseShare = $totalManagementMembers > 0 ? $managementSalesBase / $totalManagementMembers : 0.0;
            $currentFullIncome = round($baseShare, 2);
            $currentActualIncome = round(($currentPerformance / 100) * $baseShare, 2);
        } elseif ($user && $isDirector) {
            $shareAmount = (float) ($user->share_amount ?? 0);
            $base = $directorSalesBase;
            $currentFullIncome = $shareAmount > 0
                ? round(($base / 100) * $shareAmount, 2)
                : 0.0;
            $currentActualIncome = $shareAmount > 0
                ? round(($base / 100) * $shareAmount * ($currentPerformance / 100), 2)
                : 0.0;
        } elseif ($user && $isLeader) {
            $monthlySalary = (float) (UserMonthlySalary::query()
                ->where('user_id', $userId)
                ->where('year', $year)
                ->where('month', $month)
                ->value('amount') ?? 0);
            $currentFullIncome = round($monthlySalary, 2);
            $currentActualIncome = round($monthlySalary * ($currentPerformance / 100), 2);
        }

        $persistedIncome = (float) (UserSalesIncome::query()
            ->where('user_id', $userId)
            ->where('year', $year)
            ->where('month', $month)
            ->value('income_amount') ?? 0);

        if ($currentActualIncome <= 0 && $persistedIncome > 0) {
            $currentActualIncome = round($persistedIncome, 2);
        }
        if ($currentFullIncome <= 0 && $currentPerformance > 0 && $currentActualIncome > 0) {
            $currentFullIncome = round($currentActualIncome / ($currentPerformance / 100), 2);
        }

        $currentSalesIncome = $currentActualIncome;

        $incomeRows = UserSalesIncome::query()
            ->where('user_id', $userId)
            ->orderBy('year')
            ->orderBy('month')
            ->get(['year', 'month', 'income_amount']);

        $incomeLabels = $incomeRows
            ->map(fn ($row) => sprintf('%04d-%02d', (int) $row->year, (int) $row->month))
            ->values()
            ->all();

        $incomeValues = $incomeRows
            ->map(fn ($row) => (float) $row->income_amount)
            ->values()
            ->all();

        $incomeProgressPercent = 0.0;
        if ($currentFullIncome > 0) {
            $incomeProgressPercent = min(100.0, round(($currentActualIncome / $currentFullIncome) * 100, 1));
        } elseif ($currentActualIncome > 0) {
            $incomeProgressPercent = 100.0;
        }

        return view('livewire.dashboard', [
            'currentApprovedTotal' => $currentApprovedTotal,
            'currentAssignedTotal' => $currentAssignedTotal,
            'currentPerformance' => $currentPerformance,
            'monthlyLabels' => $monthlyLabels,
            'monthlyPerformances' => $monthlyPerformances,
            'currentSalesIncome' => $currentSalesIncome,
            'currentFullIncome' => $currentFullIncome,
            'currentActualIncome' => $currentActualIncome,
            'incomeProgressPercent' => $incomeProgressPercent,
            'incomeLabels' => $incomeLabels,
            'incomeValues' => $incomeValues,
        ]);
    }
}
