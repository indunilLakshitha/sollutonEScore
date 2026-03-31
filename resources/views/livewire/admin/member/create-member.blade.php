<div>
    <livewire:comp.breadcumb title="MEMBERS" section="Admin" sub="Member Management" action="Add">
        <div>
            <div class="edash-page-container container-xxl" id="edash-page-container">
                <div class="edash-content-section">
                    <div class="d-flex gap-3 gap-md-4">
                        <div class="edash-settings-content card w-100 overflow-hidden">
                            <div class="card-body">
                                <form wire:submit="addMember">
                                    <hr class="my-12 border-top-dashed" />

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
                                            <input id="member_reg_no" type="text" class="form-control" wire:model="regNo"
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
                                            <select id="member_role" class="form-select" wire:model.live='roleId'>
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
                                                        id="member_create_fixed_salary_no" value="0"
                                                        wire:model.live.boolean="fixedSalary">
                                                    <label class="form-check-label"
                                                        for="member_create_fixed_salary_no">No</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        id="member_create_fixed_salary_yes" value="1"
                                                        wire:model.live.boolean="fixedSalary">
                                                    <label class="form-check-label"
                                                        for="member_create_fixed_salary_yes">Yes</label>
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
                                            <label class="fw-semibold text-muted" for="member_password">Password (optional)</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="member_password" type="password" class="form-control" wire:model='password'
                                                placeholder="Leave empty to use DEFAULT_PASSWORD" />
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

