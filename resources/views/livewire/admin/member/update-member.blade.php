<div>
    <livewire:comp.breadcumb title="MEMBERS" section="Admin" sub="Member Management" action="Edit">
        <div>
            <div class="edash-page-container container-xxl" id="edash-page-container">
                <div class="edash-content-section">
                    <div class="d-flex gap-3 gap-md-4">
                        <div class="edash-settings-content card w-100 overflow-hidden">
                            <div class="card-body">
                                <form wire:submit="updateMember">
                                    <ul class="nav nav-tabs mb-4">
                                        <li class="nav-item">
                                            <button class="nav-link @if ($activeEditTab === 'basic') active @endif" type="button"
                                                wire:click="$set('activeEditTab', 'basic')">Basic Details</button>
                                        </li>
                                        <li class="nav-item">
                                            <button class="nav-link @if ($activeEditTab === 'salary') active @endif" type="button"
                                                wire:click="$set('activeEditTab', 'salary')">Salary Details</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane fade @if ($activeEditTab === 'basic') show active @endif" id="member-basic-tab" role="tabpanel">
                                            <div class="row g-4 mb-4">
                                                <div class="col-md-3">
                                                    <label class="fw-semibold text-muted" for="member_name">Name</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input id="member_name" type="text" class="form-control" wire:model='name'
                                                        placeholder="Name" />
                                                </div>
                                                @error('name')
                                                    <div style="color: red">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="row g-4 mb-4">
                                                <div class="col-md-3">
                                                    <label class="fw-semibold text-muted" for="member_reg_no">ER Number</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input id="member_reg_no" type="text" class="form-control" wire:model='regNo' disabled
                                                        placeholder="ER number" />
                                                </div>
                                                @error('regNo')
                                                    <div style="color: red">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="row g-4 mb-4">
                                                <div class="col-md-3">
                                                    <label class="fw-semibold text-muted" for="member_username">Username</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input id="member_username" type="text" class="form-control" wire:model='uniqueId' disabled
                                                        placeholder="Username" />
                                                </div>
                                                @error('uniqueId')
                                                    <div style="color: red">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="row g-4 mb-4">
                                                <div class="col-md-3">
                                                    <label class="fw-semibold text-muted" for="member_role">Role (position)</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <select id="member_role" class="form-select" wire:model='roleId'>
                                                        <option value="">SELECT</option>
                                                        @foreach ($roles ?? [] as $role)
                                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-muted small mb-0 mt-1">Saved as job position. &quot;Admin (Full Access)&quot; also grants admin access.</p>
                                                </div>
                                                @error('roleId')
                                                    <div style="color: red">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="row g-4 mb-4">
                                                <div class="col-md-3">
                                                    <label class="fw-semibold text-muted" for="member_phone">Phone</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input id="member_phone" type="text" class="form-control" wire:model='mobileNo'
                                                        placeholder="Phone" />
                                                </div>
                                                @error('mobileNo')
                                                    <div style="color: red">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="row g-4 mb-4">
                                                <div class="col-md-3">
                                                    <label class="fw-semibold text-muted" for="member_active">Active</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <select id="member_active" class="form-select" wire:model='activeStatus'>
                                                        <option value="{{ \App\Models\User::UNBLOCKED }}">ACTIVE</option>
                                                        <option value="{{ \App\Models\User::BLOCKED }}">INACTIVE</option>
                                                    </select>
                                                </div>
                                                @error('activeStatus')
                                                    <div style="color: red">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <hr class="my-12 border-top-dashed" />

                                            <div class="row g-4 mb-4">
                                                <div class="col-md-3">
                                                    <label class="fw-semibold text-muted" for="member_password">New Password (optional)</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input id="member_password" type="password" class="form-control" wire:model='password'
                                                        placeholder="New Password" />
                                                </div>
                                                @error('password')
                                                    <div style="color: red">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="row g-4 mb-4">
                                                <div class="col-md-3">
                                                    <label class="fw-semibold text-muted" for="member_confirm_password">Confirm Password</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input id="member_confirm_password" type="password" class="form-control" wire:model='confirmPassword'
                                                        placeholder="Confirm Password" />
                                                </div>
                                                @error('confirmPassword')
                                                    <div style="color: red">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="tab-pane fade @if ($activeEditTab === 'salary') show active @endif" id="member-salary-tab" role="tabpanel">
                                            @if ($this->isDirectorRole())
                                                <div class="row g-4 mb-4">
                                                    <div class="col-md-3">
                                                        <label class="fw-semibold text-muted" for="member_share_amount">Share amount</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input id="member_share_amount" type="number" class="form-control" step="0.01"
                                                            min="0" wire:model="shareAmount" placeholder="Enter share amount" />
                                                    </div>
                                                    @error('shareAmount')
                                                        <div style="color: red">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            @endif

                                            <div class="row g-4 mb-4">
                                                <div class="col-md-3">
                                                    <span class="fw-semibold text-muted">Fixed salary</span>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="d-flex flex-wrap gap-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                id="member_update_fixed_salary_no" value="0"
                                                                wire:model.live.boolean="fixedSalary">
                                                            <label class="form-check-label"
                                                                for="member_update_fixed_salary_no">No</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio"
                                                                id="member_update_fixed_salary_yes" value="1"
                                                                wire:model.live.boolean="fixedSalary">
                                                            <label class="form-check-label"
                                                                for="member_update_fixed_salary_yes">Yes</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                @error('fixedSalary')
                                                    <div style="color: red">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            @if ($fixedSalary === true)
                                                <div class="row g-4 mb-4">
                                                    <div class="col-md-3">
                                                        <label class="fw-semibold text-muted" for="member_salary_amount">Salary amount</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input id="member_salary_amount" type="number" class="form-control" step="0.01"
                                                            min="0" wire:model='salaryAmount' placeholder="Enter salary amount" />
                                                    </div>
                                                    @error('salaryAmount')
                                                        <div style="color: red">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            @endif

                                            <hr class="my-12 border-top-dashed" />

                                            <div class="row g-4 mb-4">
                                                <div class="col-md-3">
                                                    <label class="fw-semibold text-muted" for="salary_year">Monthly salary year</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <input id="salary_year" type="number" class="form-control" min="2000"
                                                        max="2100" wire:model.live="salaryYear" />
                                                </div>
                                                <div class="col-md-6 d-flex align-items-center">
                                                    <span class="text-muted small">Set monthly salary and sales count for this member.</span>
                                                </div>
                                            </div>

                                            <div class="row g-3 mb-4">
                                                @php($monthNames = [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'])
                                                @foreach ($monthNames as $monthNo => $monthLabel)
                                                    <div class="col-md-4 col-sm-6">
                                                        <div class="border rounded p-2">
                                                            <span class="form-label small text-muted mb-2 d-inline-block">{{ $monthLabel }}</span>
                                                            <input type="number" class="form-control mb-2" step="0.01" min="0"
                                                                wire:model="monthlySalaryInputs.{{ $monthNo }}"
                                                                placeholder="Salary amount" />
                                                            {{-- <input type="number" class="form-control" min="0"
                                                                wire:model="monthlySalesCountInputs.{{ $monthNo }}"
                                                                placeholder="Sales count" /> --}}
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                            @error('salaryYear')
                                                <div style="color: red" class="mb-2">{{ $message }}</div>
                                            @enderror
                                            @error('monthlySalaryInputs.*')
                                                <div style="color: red" class="mb-2">{{ $message }}</div>
                                            @enderror
                                            @error('monthlySalesCountInputs.*')
                                                <div style="color: red" class="mb-2">{{ $message }}</div>
                                            @enderror

                                            <div class="row g-4 mb-4">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-9">
                                                    <button class="btn btn-outline-primary" type="button"
                                                        wire:click="saveMonthlySalaries">Save monthly salaries</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="my-12 border-top-dashed" />

                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-9 d-flex gap-2">
                                            <a href="{{ route('admin.member.index') }}"
                                                class="btn btn-light text-danger">Back</a>
                                            <button class="btn btn-primary" type="submit">SAVE</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

