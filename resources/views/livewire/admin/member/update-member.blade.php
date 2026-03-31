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
                                                    <label class="fw-semibold text-muted" for="member_first_name">First name</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input id="member_first_name" type="text" class="form-control" wire:model="firstName"
                                                        placeholder="First name" />
                                                </div>
                                                @error('firstName')
                                                    <div style="color: red">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="row g-4 mb-4">
                                                <div class="col-md-3">
                                                    <label class="fw-semibold text-muted" for="member_last_name">Last name</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input id="member_last_name" type="text" class="form-control" wire:model="lastName"
                                                        placeholder="Last name" />
                                                </div>
                                                @error('lastName')
                                                    <div style="color: red">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="row g-4 mb-4">
                                                <div class="col-md-3">
                                                    <label class="fw-semibold text-muted" for="member_email">Email</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <input id="member_email" type="email" class="form-control" wire:model="email"
                                                        placeholder="Email" />
                                                </div>
                                                @error('email')
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

                                            @if ($fixedSalary !== true)
                                                <p class="text-muted small mb-3">
                                                    Enter the salary amount and the month it applies to (one saved row per month). Performance and income use this amount for that calendar month.
                                                </p>

                                                <div class="row g-4 mb-3">
                                                    <div class="col-md-3">
                                                        <label class="fw-semibold text-muted" for="salary_entry_month">Month</label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input id="salary_entry_month" type="month" class="form-control"
                                                            wire:model="salaryEntryMonth"
                                                            min="2026-01" max="2050-12" />
                                                    </div>
                                                </div>
                                                @error('salaryEntryMonth')
                                                    <div style="color: red" class="mb-2">{{ $message }}</div>
                                                @enderror

                                                <div class="row g-4 mb-3">
                                                    <div class="col-md-3">
                                                        <label class="fw-semibold text-muted" for="salary_entry_amount">Salary amount</label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input id="salary_entry_amount" type="number" class="form-control" step="0.01"
                                                            min="0" wire:model="monthlySalaryEntryAmount"
                                                            placeholder="Amount for selected month" />
                                                    </div>
                                                </div>
                                                @error('monthlySalaryEntryAmount')
                                                    <div style="color: red" class="mb-2">{{ $message }}</div>
                                                @enderror

                                                <div class="row g-4 mb-4">
                                                    <div class="col-md-3"></div>
                                                    <div class="col-md-9">
                                                        <button class="btn btn-outline-primary" type="button"
                                                            wire:click="saveMonthlySalaries">Save salary for this month</button>
                                                    </div>
                                                </div>

                                                @php($monthNames = [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'])
                                                @if (! empty($monthlySalaryRows))
                                                    <div class="table-responsive border rounded">
                                                        <table class="table table-sm mb-0">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th>Month</th>
                                                                    <th class="text-end">Salary amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($monthlySalaryRows as $row)
                                                                    <tr wire:key="salary-row-{{ $row['year'] }}-{{ $row['month'] }}">
                                                                        <td>{{ $row['year'] }} — {{ $monthNames[$row['month']] ?? $row['month'] }}</td>
                                                                        <td class="text-end">{{ number_format((float) $row['amount'], 2) }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @endif
                                            @endif
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

