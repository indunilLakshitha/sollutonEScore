<?php

namespace App\Livewire\Task;

use App\Models\CompanyMonthlySale;
use App\Models\IncomeSalesMultiplier;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use App\Models\UserMonthlySalary;
use App\Models\UserSalesIncome;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class MonthlySummary extends Component
{
    public int $year = 0;

    public function mount(): void
    {
        $this->year = (int) now()->format('Y');
    }

    public function updatedYear(): void
    {
        // keep as a hook for live updates
    }

    public function render()
    {
        $userId = (int) Auth::id();
        $year = (int) $this->year;

        $user = User::query()->whereKey($userId)->first();
        if (!$user) {
            abort(404);
        }

        $managementRoleId = Role::query()->where('slug', Role::SLUG_MANAGEMENT)->value('id');
        $directorRoleId = Role::query()->where('slug', Role::SLUG_DIRECTOR)->value('id');
        $leaderRoleId = Role::query()->where('slug', Role::SLUG_LEADER)->value('id');

        $coeff = IncomeSalesMultiplier::query()->first();
        $managementMultiplier = (float) ($coeff->management_multiplier ?? 1000);
        $directorMultiplier = (float) ($coeff->director_multiplier ?? 4000);

        $companySalesByMonth = CompanyMonthlySale::query()
            ->where('year', $year)
            ->pluck('sales_count', 'month')
            ->map(fn ($v) => (int) $v)
            ->all();

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

        $totalTasksByMonth = Task::query()
            ->where('assigned_user_id', $userId)
            ->whereYear('created_at', $year)
            ->selectRaw('MONTH(created_at) as m, COUNT(*) as c')
            ->groupBy('m')
            ->pluck('c', 'm')
            ->map(fn ($v) => (int) $v)
            ->all();

        $pendingTasksByMonth = Task::query()
            ->where('assigned_user_id', $userId)
            ->whereYear('created_at', $year)
            ->where('status', Task::STATUS_ASSIGNED)
            ->selectRaw('MONTH(created_at) as m, COUNT(*) as c')
            ->groupBy('m')
            ->pluck('c', 'm')
            ->map(fn ($v) => (int) $v)
            ->all();

        $completedTasksByMonth = Task::query()
            ->where('assigned_user_id', $userId)
            ->whereYear('created_at', $year)
            ->whereIn('status', [Task::STATUS_SUBMITTED, Task::STATUS_APPROVED, Task::STATUS_REJECTED])
            ->selectRaw('MONTH(created_at) as m, COUNT(*) as c')
            ->groupBy('m')
            ->pluck('c', 'm')
            ->map(fn ($v) => (int) $v)
            ->all();

        $expiredTasksByMonth = Task::query()
            ->where('assigned_user_id', $userId)
            ->whereYear('created_at', $year)
            ->whereNotNull('deadline_at')
            ->where('status', '!=', Task::STATUS_APPROVED)
            ->where('deadline_at', '<', DB::raw("LAST_DAY(CONCAT($year,'-',LPAD(MONTH(created_at),2,'0'),'-01'))"))
            ->selectRaw('MONTH(created_at) as m, COUNT(*) as c')
            ->groupBy('m')
            ->pluck('c', 'm')
            ->map(fn ($v) => (int) $v)
            ->all();

        $salaryByMonth = UserMonthlySalary::query()
            ->where('user_id', $userId)
            ->where('year', $year)
            ->pluck('amount', 'month')
            ->map(fn ($v) => (float) $v)
            ->all();

        $salesIncomeByMonth = UserSalesIncome::query()
            ->where('user_id', $userId)
            ->where('year', $year)
            ->pluck('income_amount', 'month')
            ->map(fn ($v) => (float) $v)
            ->all();

        // Fallback for legacy data where role_id may be empty but position text exists.
        $position = strtolower(trim((string) ($user->position ?? '')));
        $isManagement = ($managementRoleId && (int) $user->role_id === (int) $managementRoleId)
            || str_contains($position, 'management');
        $isDirector = ($directorRoleId && (int) $user->role_id === (int) $directorRoleId)
            || str_contains($position, 'director');
        $isLeader = ($leaderRoleId && (int) $user->role_id === (int) $leaderRoleId)
            || str_contains($position, 'leader');

        $totalManagementMembers = ($managementRoleId && $user->role_id == $managementRoleId)
            ? (int) User::query()->where('role_id', $managementRoleId)->count()
            : 0;

        $months = [];
        for ($m = 1; $m <= 12; $m++) {
            $totalTasks = (int) ($totalTasksByMonth[$m] ?? 0);
            if ($totalTasks <= 0) {
                continue;
            }

            $assignedScore = (float) ($assignedScoreByMonth[$m] ?? 0);
            $approvedScore = (float) ($approvedScoreByMonth[$m] ?? 0);
            $performance = $assignedScore > 0 ? round(($approvedScore / $assignedScore) * 100, 2) : 0.0;

            $salesCount = (int) ($companySalesByMonth[$m] ?? 0);
            $fullIncome = 0.0;
            $actualIncome = 0.0;

            if ($isManagement) {
                $baseShare = $totalManagementMembers > 0
                    ? (($salesCount * $managementMultiplier) / $totalManagementMembers)
                    : 0.0;
                $fullIncome = round($baseShare, 2);
                $actualIncome = round(($performance / 100) * $baseShare, 2);
            } elseif ($isDirector) {
                $shareAmount = (float) ($user->share_amount ?? 0);
                $base = $salesCount * $directorMultiplier;
                $fullIncome = $shareAmount > 0 ? round(($base / 100) * $shareAmount, 2) : 0.0;
                $actualIncome = $shareAmount > 0
                    ? round(($base / 100) * $shareAmount * ($performance / 100), 2)
                    : 0.0;
            } elseif ($isLeader) {
                $salary = (float) ($salaryByMonth[$m] ?? 0);
                $fullIncome = round($salary, 2);
                $actualIncome = round($salary * ($performance / 100), 2);
            }

            // If role-based calculation doesn't produce values, use persisted monthly income.
            if ($actualIncome <= 0 && isset($salesIncomeByMonth[$m])) {
                $actualIncome = round((float) $salesIncomeByMonth[$m], 2);
            }
            if ($fullIncome <= 0 && $performance > 0 && $actualIncome > 0) {
                $fullIncome = round($actualIncome / ($performance / 100), 2);
            }

            $pendingTasks = (int) ($pendingTasksByMonth[$m] ?? 0);
            $completedTasks = (int) ($completedTasksByMonth[$m] ?? 0);
            $expiredTasks = (int) ($expiredTasksByMonth[$m] ?? 0);

            $taskCompletionRate = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100, 2) : 0.0;
            $progressPercent = $totalTasks > 0 ? (int) round(($completedTasks / $totalTasks) * 100) : 0;

            $months[] = [
                'month' => $m,
                'label' => sprintf('%04d-%02d', $year, $m),
                'sales_count' => $salesCount,
                'assigned_score' => $assignedScore,
                'approved_score' => $approvedScore,
                'performance' => $performance,
                'full_income' => $fullIncome,
                'actual_income' => $actualIncome,
                'total_tasks' => $totalTasks,
                'completed_tasks' => $completedTasks,
                'pending_tasks' => $pendingTasks,
                'expired_tasks' => $expiredTasks,
                'task_completion_rate' => $taskCompletionRate,
                'progress_percent' => max(0, min(100, $progressPercent)),
            ];
        }

        return view('livewire.task.monthly-summary', [
            'user' => $user,
            'months' => $months,
        ]);
    }
}

