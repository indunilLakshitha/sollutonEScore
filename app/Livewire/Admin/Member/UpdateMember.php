<?php

namespace App\Livewire\Admin\Member;

use App\Models\Role;
use App\Models\User;
use App\Models\UserMonthlySalary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;

class UpdateMember extends Component
{
    private const MIN_SALARY_YEAR = 2026;
    private const MAX_SALARY_YEAR = 2050;

    public int $id;

    /** Which member edit tab is visible: basic | salary (kept across Livewire re-renders). */
    public string $activeEditTab = 'basic';

    public string $firstName = '';
    public string $lastName = '';
    public string $email = '';
    public ?string $regNo = null;
    public ?int $roleId = null;

    public ?string $mobileNo = null;
    public bool $fixedSalary = false;

    public ?string $salaryAmount = null;
    public ?string $shareAmount = null;

    public int $activeStatus = User::UNBLOCKED;

    public ?string $password = null;
    public ?string $confirmPassword = null;

    /** Calendar month for the entry (HTML month input: YYYY-MM). */
    public ?string $salaryEntryMonth = null;

    public ?string $monthlySalaryEntryAmount = null;

    /** @var array<int, array{year: int, month: int, amount: string, sales_count: int}> */
    public array $monthlySalaryRows = [];

    /** @var \Illuminate\Database\Eloquent\Collection<int, Role>|null */
    public $roles;

    public function mount($id): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $user = User::query()->whereKey($id)->firstOrFail();
        $this->id = (int) $user->id;

        $this->firstName = (string) ($user->first_name ?? '');
        $this->lastName = (string) ($user->last_name ?? '');
        $this->email = (string) ($user->email ?? '');
        $this->regNo = $user->reg_no;
        $this->mobileNo = $user->mobile_no;
        $this->fixedSalary = ((int) ($user->fixed_salary ?? 0)) === 1;
        $this->salaryAmount = $user->salary_amount !== null
            ? (string) $user->salary_amount
            : null;
        $this->shareAmount = $user->share_amount !== null
            ? (string) $user->share_amount
            : null;
        $this->activeStatus = (int) ($user->active_status ?? User::UNBLOCKED);

        $this->roleId = $user->role_id ? (int) $user->role_id : null;
        if ($this->roleId === null && Schema::hasTable('roles') && $user->position) {
            $this->roleId = Role::query()->where('name', $user->position)->value('id');
        }

        $this->roles = Role::query()->orderBy('sort_order')->orderBy('id')->get();

        $this->salaryEntryMonth = $this->clampSalaryMonthString(now()->format('Y-m'));
        $this->refreshMonthlySalaryRows();
    }

    public function updatedFixedSalary(): void
    {
        if (!$this->fixedSalary) {
            $this->salaryAmount = null;
        }
    }

    public function updatedRoleId(): void
    {
        if (!$this->isDirectorRole()) {
            $this->shareAmount = null;
        }
    }

    public function saveMonthlySalaries(): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        if ($this->fixedSalary) {
            $this->dispatch('error_alert', ['title' => 'Monthly salary is disabled when fixed salary is enabled.']);

            return;
        }

        $this->validate([
            'salaryEntryMonth' => 'required|date_format:Y-m',
            'monthlySalaryEntryAmount' => 'required|numeric|min:0|max:999999999.99',
        ]);

        $parts = explode('-', (string) $this->salaryEntryMonth);
        $year = (int) ($parts[0] ?? 0);
        $month = (int) ($parts[1] ?? 0);
        if ($year < self::MIN_SALARY_YEAR || $year > self::MAX_SALARY_YEAR || $month < 1 || $month > 12) {
            $this->addError('salaryEntryMonth', 'Choose a month between '.self::MIN_SALARY_YEAR.' and '.self::MAX_SALARY_YEAR.'.');

            return;
        }

        $amount = round((float) $this->monthlySalaryEntryAmount, 2);

        $existing = UserMonthlySalary::query()
            ->where('user_id', $this->id)
            ->where('year', $year)
            ->where('month', $month)
            ->first();

        UserMonthlySalary::query()->updateOrCreate(
            [
                'user_id' => $this->id,
                'year' => $year,
                'month' => $month,
            ],
            [
                'amount' => $amount,
                'sales_count' => (int) ($existing?->sales_count ?? 0),
            ]
        );

        $this->refreshMonthlySalaryRows();
        $this->monthlySalaryEntryAmount = null;
        $this->dispatch('success_alert', ['title' => 'Salary saved for '.sprintf('%04d-%02d', $year, $month).'.']);
    }

    public function updateMember(): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $rules = [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|max:255|unique:users,email,' . $this->id,
            'regNo' => 'required|string|max:255|unique:users,reg_no,' . $this->id,
            'mobileNo' => 'nullable|string|max:255',
            'fixedSalary' => 'required|boolean',
            'activeStatus' => 'required|integer|in:' . User::UNBLOCKED . ',' . User::BLOCKED,
            'password' => 'nullable|min:6|required_with:confirmPassword|same:confirmPassword',
            'confirmPassword' => 'nullable|min:6',
        ];

        if (Schema::hasTable('roles')) {
            $rules['roleId'] = 'required|integer|exists:roles,id';
        }

        if (Schema::hasColumn('users', 'salary_amount')) {
            $rules['salaryAmount'] = $this->fixedSalary
                ? 'required|numeric|min:0|max:999999999.99'
                : 'nullable';
        }
        if (Schema::hasColumn('users', 'share_amount')) {
            $rules['shareAmount'] = $this->isDirectorRole()
                ? 'required|numeric|min:0|max:999999999.99'
                : 'nullable';
        }

        $this->validate($rules);

        $user = User::query()->whereKey($this->id)->firstOrFail();
        $user->first_name = $this->firstName;
        $user->last_name = $this->lastName;
        $user->name = trim($this->firstName . ' ' . $this->lastName);
        // $user->reg_no = $this->regNo;
        // $user->unique_id = $this->uniqueId;
        $user->mobile_no = $this->mobileNo;
        $user->email = $this->email;

        $role = Schema::hasTable('roles')
            ? Role::query()->whereKey($this->roleId)->firstOrFail()
            : null;
        if ($role) {
            $user->role_id = $role->id;
            $user->position = $role->name;
            $user->is_admin = $role->full_access ? 1 : 0;
        }

        if (Schema::hasColumn('users', 'fixed_salary')) {
            $user->fixed_salary = $this->fixedSalary ? 1 : 0;
        }
        if (Schema::hasColumn('users', 'salary_amount')) {
            $user->salary_amount = $this->fixedSalary && $this->salaryAmount !== null && $this->salaryAmount !== ''
                ? round((float) $this->salaryAmount, 2)
                : null;
        }
        if (Schema::hasColumn('users', 'share_amount')) {
            $user->share_amount = $this->isDirectorRole() && $this->shareAmount !== null && $this->shareAmount !== ''
                ? round((float) $this->shareAmount, 2)
                : null;
        }
        $user->active_status = $this->activeStatus;

        if ($this->password) {
            $user->password = Hash::make($this->password);
        }

        $user->save();

        $this->password = null;
        $this->confirmPassword = null;

        $this->dispatch('success_alert', ['title' => 'Member updated.']);
    }

    private function refreshMonthlySalaryRows(): void
    {
        $this->monthlySalaryRows = UserMonthlySalary::query()
            ->where('user_id', $this->id)
            ->orderByDesc('year')
            ->orderByDesc('month')
            ->get(['year', 'month', 'amount', 'sales_count'])
            ->map(fn (UserMonthlySalary $r): array => [
                'year' => (int) $r->year,
                'month' => (int) $r->month,
                'amount' => (string) $r->amount,
                'sales_count' => (int) ($r->sales_count ?? 0),
            ])
            ->values()
            ->all();
    }

    private function clampSalaryMonthString(string $ym): string
    {
        $parts = explode('-', $ym);
        $y = (int) ($parts[0] ?? self::MIN_SALARY_YEAR);
        $m = (int) ($parts[1] ?? 1);
        $y = max(self::MIN_SALARY_YEAR, min(self::MAX_SALARY_YEAR, $y));
        $m = max(1, min(12, $m));

        return sprintf('%04d-%02d', $y, $m);
    }

    public function render()
    {
        return view('livewire.admin.member.update-member');
    }

    public function isDirectorRole(): bool
    {
        if (!$this->roleId) {
            return false;
        }

        return Role::query()
            ->whereKey($this->roleId)
            ->where('slug', Role::SLUG_DIRECTOR)
            ->exists();
    }
}
