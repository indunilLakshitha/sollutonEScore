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
    public int $id;

    /** Which member edit tab is visible: basic | salary (kept across Livewire re-renders). */
    public string $activeEditTab = 'basic';

    public string $name = '';
    public ?string $regNo = null;
    public ?int $roleId = null;

    public ?string $uniqueId = null;
    public ?string $mobileNo = null;
    public bool $fixedSalary = false;

    public ?string $salaryAmount = null;
    public ?string $shareAmount = null;

    public int $activeStatus = User::UNBLOCKED;

    public ?string $password = null;
    public ?string $confirmPassword = null;

    public int $salaryYear = 0;

    /** @var array<int, string|null> */
    public array $monthlySalaryInputs = [];

    /** @var array<int, string|null> */
    public array $monthlySalesCountInputs = [];

    /** @var \Illuminate\Database\Eloquent\Collection<int, Role>|null */
    public $roles;

    public function mount($id): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $user = User::query()->whereKey($id)->firstOrFail();
        $this->id = (int) $user->id;

        $this->name = (string) $user->name;
        $this->regNo = $user->reg_no;
        $this->uniqueId = $user->unique_id;
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

        $this->salaryYear = (int) now()->format('Y');
        $this->loadMonthlySalaries();
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

    public function updatedSalaryYear(): void
    {
        $this->loadMonthlySalaries();
    }

    public function saveMonthlySalaries(): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $this->validate([
            'salaryYear' => 'required|integer|min:2000|max:2100',
            'monthlySalaryInputs' => 'required|array|size:12',
            'monthlySalaryInputs.*' => 'nullable|numeric|min:0|max:999999999.99',
            'monthlySalesCountInputs' => 'required|array|size:12',
            'monthlySalesCountInputs.*' => 'nullable|integer|min:0|max:100000000',
        ]);

        for ($month = 1; $month <= 12; $month++) {
            $rawSalary = $this->monthlySalaryInputs[$month] ?? null;
            $rawCount = $this->monthlySalesCountInputs[$month] ?? null;

            if (($rawSalary === null || $rawSalary === '') && ($rawCount === null || $rawCount === '')) {
                UserMonthlySalary::query()
                    ->where('user_id', $this->id)
                    ->where('year', $this->salaryYear)
                    ->where('month', $month)
                    ->delete();

                continue;
            }

            UserMonthlySalary::query()->updateOrCreate(
                [
                    'user_id' => $this->id,
                    'year' => $this->salaryYear,
                    'month' => $month,
                ],
                [
                    'amount' => ($rawSalary === null || $rawSalary === '') ? 0 : round((float) $rawSalary, 2),
                    'sales_count' => ($rawCount === null || $rawCount === '') ? 0 : (int) $rawCount,
                ]
            );
        }

        $this->loadMonthlySalaries();
        $this->dispatch('success_alert', ['title' => 'Monthly salary and sales count saved.']);
    }

    public function updateMember(): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $rules = [
            'name' => 'required|string',
            'regNo' => 'required|string|max:255|unique:users,reg_no,' . $this->id,
            'uniqueId' => 'nullable|string|max:255|unique:users,unique_id,' . $this->id,
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
        $user->name = $this->name;
        // $user->reg_no = $this->regNo;
        // $user->unique_id = $this->uniqueId;
        $user->mobile_no = $this->mobileNo;

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
        $user->email = $this->regNo; // keep in sync with current Fortify lookup

        if ($this->password) {
            $user->password = Hash::make($this->password);
        }

        $user->save();

        $this->password = null;
        $this->confirmPassword = null;

        $this->dispatch('success_alert', ['title' => 'Member updated.']);
    }

    private function loadMonthlySalaries(): void
    {
        $this->monthlySalaryInputs = [];
        $this->monthlySalesCountInputs = [];
        for ($month = 1; $month <= 12; $month++) {
            $this->monthlySalaryInputs[$month] = null;
            $this->monthlySalesCountInputs[$month] = null;
        }

        $rows = UserMonthlySalary::query()
            ->where('user_id', $this->id)
            ->where('year', $this->salaryYear)
            ->get(['month', 'amount', 'sales_count']);

        foreach ($rows as $row) {
            $this->monthlySalaryInputs[(int) $row->month] = (string) $row->amount;
            $this->monthlySalesCountInputs[(int) $row->month] = (string) ((int) ($row->sales_count ?? 0));
        }
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
