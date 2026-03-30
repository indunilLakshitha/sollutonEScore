<?php

namespace App\Livewire\Admin\Performance;

use App\Models\CompanyMonthlySale;
use App\Models\IncomeSalesMultiplier;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use App\Models\UserMonthlyBonus;
use App\Models\UserMonthlySalary;
use App\Models\UserPerformance;
use App\Models\UserSalesIncome;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class MemberPerformances extends Component
{
    use WithPagination;

    public string $search = '';

    public int $year = 0;

    public int $month = 0;

    public function mount(): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $this->year = (int) now()->format('Y');
        $this->month = (int) now()->format('n');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatedYear(): void
    {
        $this->resetPage();
    }

    public function updatedMonth(): void
    {
        $this->resetPage();
    }

    public function saveBonusType(int $userId, string $bonusType): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $bonusType = strtolower(trim($bonusType));
        $year = $this->year;
        $month = $this->month;

        if ($bonusType === '' || $bonusType === '__clear__') {
            UserMonthlyBonus::query()
                ->where('user_id', $userId)
                ->where('year', $year)
                ->where('month', $month)
                ->delete();
            $this->dispatch('success_alert', ['title' => 'Bonus type cleared.']);

            return;
        }

        if (!in_array($bonusType, [UserMonthlyBonus::TYPE_CASH, UserMonthlyBonus::TYPE_GIFT], true)) {
            $this->dispatch('success_alert', ['title' => 'Invalid bonus type.']);

            return;
        }

        $user = User::query()->whereKey($userId)->firstOrFail();
        $managementRoleId = Role::query()->where('slug', Role::SLUG_MANAGEMENT)->value('id');
        $leaderRoleId = Role::query()->where('slug', Role::SLUG_LEADER)->value('id');

        $asOf = $this->bonusEvaluationAsOf($year, $month);

        if (!$this->userMeetsBonusEligibility($user, $year, $month, $asOf, $managementRoleId, $leaderRoleId)) {
            $this->dispatch('success_alert', ['title' => 'This member is not bonus eligible for the selected month.']);

            return;
        }

        $row = UserMonthlyBonus::query()->firstOrNew([
            'user_id' => $userId,
            'year' => $year,
            'month' => $month,
        ]);

        $row->bonus_type = $bonusType;
        if ($bonusType === UserMonthlyBonus::TYPE_CASH) {
            $row->gift_name = null;
        } else {
            $row->cash_amount = null;
        }
        $row->save();

        $this->dispatch('success_alert', ['title' => 'Bonus type saved.']);
    }

    public function saveBonusCashAmount(int $userId, $amount): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $year = $this->year;
        $month = $this->month;

        $user = User::query()->whereKey($userId)->firstOrFail();
        $managementRoleId = Role::query()->where('slug', Role::SLUG_MANAGEMENT)->value('id');
        $leaderRoleId = Role::query()->where('slug', Role::SLUG_LEADER)->value('id');
        $asOf = $this->bonusEvaluationAsOf($year, $month);

        if (!$this->userMeetsBonusEligibility($user, $year, $month, $asOf, $managementRoleId, $leaderRoleId)) {
            $this->dispatch('success_alert', ['title' => 'This member is not bonus eligible for the selected month.']);
            return;
        }

        $bonus = UserMonthlyBonus::query()->firstOrNew([
            'user_id' => $userId,
            'year' => $year,
            'month' => $month,
        ]);

        $bonus->bonus_type = UserMonthlyBonus::TYPE_CASH;
        $bonus->cash_amount = is_numeric($amount) ? (float) $amount : null;
        $bonus->gift_name = null;
        $bonus->save();

        $this->dispatch('success_alert', ['title' => 'Cash bonus saved.']);
    }

    public function saveBonusGiftName(int $userId, string $giftName): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $giftName = trim($giftName);
        $year = $this->year;
        $month = $this->month;

        $user = User::query()->whereKey($userId)->firstOrFail();
        $managementRoleId = Role::query()->where('slug', Role::SLUG_MANAGEMENT)->value('id');
        $leaderRoleId = Role::query()->where('slug', Role::SLUG_LEADER)->value('id');
        $asOf = $this->bonusEvaluationAsOf($year, $month);

        if (!$this->userMeetsBonusEligibility($user, $year, $month, $asOf, $managementRoleId, $leaderRoleId)) {
            $this->dispatch('success_alert', ['title' => 'This member is not bonus eligible for the selected month.']);
            return;
        }

        if ($giftName === '') {
            $this->dispatch('success_alert', ['title' => 'Gift name is required.']);
            return;
        }

        $bonus = UserMonthlyBonus::query()->firstOrNew([
            'user_id' => $userId,
            'year' => $year,
            'month' => $month,
        ]);

        $bonus->bonus_type = UserMonthlyBonus::TYPE_GIFT;
        $bonus->gift_name = $giftName;
        $bonus->cash_amount = null;
        $bonus->save();

        $this->dispatch('success_alert', ['title' => 'Gift bonus saved.']);
    }

    public function render()
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $year = $this->year;
        $month = $this->month;

        $companySalesCount = (int) (CompanyMonthlySale::query()
            ->where('year', $year)
            ->where('month', $month)
            ->value('sales_count') ?? 0);
        $coeff = IncomeSalesMultiplier::query()->first();
        $managementMultiplier = (float) ($coeff->management_multiplier ?? 1000);
        $directorMultiplier = (float) ($coeff->director_multiplier ?? 4000);

        $managementSalesBase = $companySalesCount * $managementMultiplier;
        $directorSalesBase = $companySalesCount * $directorMultiplier;

        $managementRoleId = Role::query()->where('slug', Role::SLUG_MANAGEMENT)->value('id');
        $directorRoleId = Role::query()->where('slug', Role::SLUG_DIRECTOR)->value('id');
        $leaderRoleId = Role::query()->where('slug', Role::SLUG_LEADER)->value('id');
        $totalManagementMembers = $managementRoleId
            ? (int) User::query()->where('role_id', $managementRoleId)->count()
            : 0;

        $assignedSub = Task::query()
            ->selectRaw('assigned_user_id, COALESCE(SUM(max_score), 0) as assigned_total')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->groupBy('assigned_user_id');

        $approvedSub = Task::query()
            ->selectRaw('assigned_user_id, COALESCE(SUM(score), 0) as approved_total')
            ->where('status', Task::STATUS_APPROVED)
            ->whereYear('approved_at', $year)
            ->whereMonth('approved_at', $month)
            ->groupBy('assigned_user_id');

        $salarySub = UserMonthlySalary::query()
            ->selectRaw('user_id, COALESCE(SUM(amount), 0) as month_salary')
            ->where('year', $year)
            ->where('month', $month)
            ->groupBy('user_id');

        $members = User::query()
            ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
            ->leftJoinSub($assignedSub, 'assigned_month', function ($join) {
                $join->on('assigned_month.assigned_user_id', '=', 'users.id');
            })
            ->leftJoinSub($approvedSub, 'approved_month', function ($join) {
                $join->on('approved_month.assigned_user_id', '=', 'users.id');
            })
            ->leftJoinSub($salarySub, 'salary_month', function ($join) {
                $join->on('salary_month.user_id', '=', 'users.id');
            })
            ->when($this->search !== '', function ($q) {
                $s = trim($this->search);
                $q->where(function ($qq) use ($s) {
                    $qq->where('users.name', 'like', "%{$s}%")
                        ->orWhere('users.reg_no', 'like', "%{$s}%")
                        ->orWhere('users.unique_id', 'like', "%{$s}%")
                        ->orWhere('roles.name', 'like', "%{$s}%");
                });
            })
            ->select([
                'users.id',
                'users.name',
                'users.reg_no',
                'users.unique_id',
                'users.role_id',
                'users.share_amount',
                DB::raw('COALESCE(roles.name, users.position, "-") as role_name'),
                DB::raw('COALESCE(assigned_month.assigned_total, 0) as assigned_total'),
                DB::raw('COALESCE(approved_month.approved_total, 0) as approved_total'),
                DB::raw('COALESCE(salary_month.month_salary, 0) as month_salary'),
            ])
            ->orderByDesc('users.id')
            ->paginate(15);

        $asOf = $this->bonusEvaluationAsOf($year, $month);

        $pageUserIds = $members->getCollection()->pluck('id')->map(fn ($id) => (int) $id)->all();

        $rejectedSet = $this->userIdsWithRejectedTasksInMonth($pageUserIds, $year, $month);
        $expiredSet = $this->userIdsWithExpiredTasksInMonth($pageUserIds, $year, $month, $asOf);

        $bonusTypeMap = empty($pageUserIds)
            ? []
            : UserMonthlyBonus::query()
                ->where('year', $year)
                ->where('month', $month)
                ->whereIn('user_id', $pageUserIds)
                ->get(['user_id', 'bonus_type', 'cash_amount', 'gift_name'])
                ->keyBy('user_id')
                ->all();

        $members->getCollection()->transform(function ($row) use ($managementRoleId, $directorRoleId, $leaderRoleId, $totalManagementMembers, $managementSalesBase, $directorSalesBase, $rejectedSet, $expiredSet, $bonusTypeMap) {
            $assignedTotal = (float) ($row->assigned_total ?? 0);
            $approvedTotal = (float) ($row->approved_total ?? 0);
            $performance = $assignedTotal > 0 ? round(($approvedTotal / $assignedTotal) * 100, 2) : 0.0;

            $income = 0.0;
            if ($managementRoleId && (int) $row->role_id === (int) $managementRoleId) {
                $baseShare = $totalManagementMembers > 0 ? $managementSalesBase / $totalManagementMembers : 0.0;
                $income = round(($performance / 100) * $baseShare, 2);
            } elseif ($directorRoleId && (int) $row->role_id === (int) $directorRoleId) {
                $shareAmount = (float) ($row->share_amount ?? 0);
                $income = $shareAmount > 0
                    ? round(($directorSalesBase / 100) * $shareAmount * ($performance / 100), 2)
                    : 0.0;
            } elseif ($leaderRoleId && (int) $row->role_id === (int) $leaderRoleId) {
                $monthlySalary = (float) ($row->month_salary ?? 0);
                $income = round($monthlySalary * ($performance / 100), 2);
            }

            $row->performance = $performance;
            $row->sales_income = $income;

            $uid = (int) $row->id;
            $row->bonus_eligible = $this->isBonusEligibleRow(
                $row,
                $assignedTotal,
                $performance,
                $rejectedSet,
                $expiredSet,
                $managementRoleId,
                $leaderRoleId
            );
            $bonusRow = $bonusTypeMap[$uid] ?? null;
            $row->bonus_type_saved = $bonusRow?->bonus_type ?? null;
            $row->bonus_cash_amount = $bonusRow?->cash_amount ?? null;
            $row->bonus_gift_name = $bonusRow?->gift_name ?? null;

            return $row;
        });

        return view('livewire.admin.performance.member-performances', compact('members'));
    }

    /**
     * @param  array<int, true>  $rejectedSet
     * @param  array<int, true>  $expiredSet
     */
    private function isBonusEligibleRow(
        object $row,
        float $assignedTotal,
        float $performance,
        array $rejectedSet,
        array $expiredSet,
        ?int $managementRoleId,
        ?int $leaderRoleId
    ): bool {
        $uid = (int) $row->id;
        $isMgmtOrLeader = ($managementRoleId && (int) $row->role_id === (int) $managementRoleId)
            || ($leaderRoleId && (int) $row->role_id === (int) $leaderRoleId);

        if (!$isMgmtOrLeader) {
            return false;
        }

        if ($assignedTotal <= 0) {
            return false;
        }

        if (round($performance, 2) < 100.0) {
            return false;
        }

        if (isset($rejectedSet[$uid])) {
            return false;
        }

        if (isset($expiredSet[$uid])) {
            return false;
        }

        return true;
    }

    private function bonusEvaluationAsOf(int $year, int $month): Carbon
    {
        $endOfMonth = Carbon::create($year, $month, 1)->endOfMonth();

        return now()->lessThan($endOfMonth) ? now() : $endOfMonth;
    }

    /**
     * @param  array<int, int>  $userIds
     * @return array<int, true>
     */
    private function userIdsWithRejectedTasksInMonth(array $userIds, int $year, int $month): array
    {
        if ($userIds === []) {
            return [];
        }

        $ids = Task::query()
            ->whereIn('assigned_user_id', $userIds)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->where('status', Task::STATUS_REJECTED)
            ->distinct()
            ->pluck('assigned_user_id')
            ->all();

        return array_fill_keys(array_map('intval', $ids), true);
    }

    /**
     * Tasks assigned in the month whose deadline passed before evaluation time and are still not approved.
     *
     * @param  array<int, int>  $userIds
     * @return array<int, true>
     */
    private function userIdsWithExpiredTasksInMonth(array $userIds, int $year, int $month, Carbon $asOf): array
    {
        if ($userIds === []) {
            return [];
        }

        $ids = Task::query()
            ->whereIn('assigned_user_id', $userIds)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->whereNotNull('deadline_at')
            ->where('deadline_at', '<', $asOf)
            ->where('status', '!=', Task::STATUS_APPROVED)
            ->distinct()
            ->pluck('assigned_user_id')
            ->all();

        return array_fill_keys(array_map('intval', $ids), true);
    }

    private function userMeetsBonusEligibility(
        User $user,
        int $year,
        int $month,
        Carbon $asOf,
        ?int $managementRoleId,
        ?int $leaderRoleId
    ): bool {
        $isMgmtOrLeader = ($managementRoleId && (int) $user->role_id === (int) $managementRoleId)
            || ($leaderRoleId && (int) $user->role_id === (int) $leaderRoleId);

        if (!$isMgmtOrLeader) {
            return false;
        }

        $assignedTotal = (float) Task::query()
            ->where('assigned_user_id', $user->id)
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->sum('max_score');

        $approvedTotal = (float) Task::query()
            ->where('assigned_user_id', $user->id)
            ->where('status', Task::STATUS_APPROVED)
            ->whereYear('approved_at', $year)
            ->whereMonth('approved_at', $month)
            ->sum('score');

        $performance = $assignedTotal > 0 ? round(($approvedTotal / $assignedTotal) * 100, 2) : 0.0;

        $rejectedSet = $this->userIdsWithRejectedTasksInMonth([(int) $user->id], $year, $month);
        $expiredSet = $this->userIdsWithExpiredTasksInMonth([(int) $user->id], $year, $month, $asOf);

        return $this->isBonusEligibleRow(
            $user,
            $assignedTotal,
            $performance,
            $rejectedSet,
            $expiredSet,
            $managementRoleId,
            $leaderRoleId
        );
    }
}
