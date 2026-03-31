<?php

namespace App\Livewire\Admin\Member;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;

class CreateMember extends Component
{
    public string $firstName = '';
    public string $lastName = '';
    public string $email = '';
    public ?string $regNo = null;     // ER number (used as user id)
    public ?int $roleId = null;

    public ?string $mobileNo = null;
    public bool $fixedSalary = false;

    /** Required when fixed salary is enabled */
    public ?string $salaryAmount = null;
    public ?string $shareAmount = null;

    public int $activeStatus = User::UNBLOCKED;

    public ?string $password = null;
    public ?string $confirmPassword = null;

    /** @var \Illuminate\Database\Eloquent\Collection<int, Role>|null */
    public $roles;

    public function mount(): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $this->roles = Role::query()->orderBy('sort_order')->orderBy('id')->get();
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

    public function addMember(): void
    {
        if (!Auth::user()?->is_admin) {
            abort(404);
        }

        $rules = [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|max:255|unique:users,email',
            'regNo' => 'required|string|max:255|unique:users,reg_no',
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

        $pw = $this->password ?: (string) (config('app.default_password') ?: env('DEFAULT_PASSWORD', '123456789'));

        $role = Schema::hasTable('roles')
            ? Role::query()->whereKey($this->roleId)->firstOrFail()
            : null;

        $user = new User();
        $user->first_name = $this->firstName;
        $user->last_name = $this->lastName;
        $user->name = trim($this->firstName . ' ' . $this->lastName);
        $user->email = $this->email;
        $user->reg_no = $this->regNo;
        $user->mobile_no = $this->mobileNo;
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
        $user->password = Hash::make($pw);
        $user->save();

        $this->reset([
            'firstName',
            'lastName',
            'email',
            'regNo',
            'roleId',
            'mobileNo',
            'fixedSalary',
            'salaryAmount',
            'shareAmount',
            'activeStatus',
            'password',
            'confirmPassword',
        ]);
        $this->resetValidation();
        $this->dispatch('success_alert', ['title' => 'Member created.']);
    }

    public function render()
    {
        return view('livewire.admin.member.create-member');
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
