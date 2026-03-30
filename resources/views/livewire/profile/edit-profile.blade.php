<div>
    <livewire:comp.breadcumb title="PROFILE" section="User" sub="Profile" action="Edit">
        <div>
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <!--! Start:: Content Section !-->
            <div class="edash-page-container container-xxl" id="edash-page-container">
                <!--! Start:: Content Section !-->
                <div class="edash-content-section">
                    <div class="d-flex gap-3 gap-md-4">
                        <!-- Start:: edash-settings-aside -->
                        <div
                            class="edash-settings-aside card wd-350 min-wd-350 bg-body-tertiary sticky-top z-1000 d-none d-lg-flex">
                            <!--! Start:: settings-aside-header !-->
                            <div class="px-4 d-flex align-items-center border-bottom min-ht-80">
                                <h2 class="fs-18 fw-semibold mb-0">Navigation</h2>
                            </div>
                            <!--! End:: settings-aside-header !-->
                            <!--! Start:: settings-nav-items !-->
                            <nav class="nav px-2 py-4 overflow-auto">
                                <!--! Start:: setting-account  !-->
                                <a wire:click='showBasic' class="nav-link w-100 mb-3 d-flex align-items-center active"
                                    aria-current="page">
                                    <div class="avatar avatar-lg rounded bg-body-secondary flex-shrink-0">
                                        <i class="fi fi-rr-user fs-3"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6>Profile</h6>
                                        <p class="fs-13 fw-normal text-muted mb-0">
                                            Name, ER no, email, mobile
                                        </p>
                                    </div>
                                    <div class="btn btn-icon btn-light ms-auto flex-shrink-0">
                                        <i class="fi fi-rr-angle-small-right"></i>
                                    </div>
                                </a>
                                <a wire:click='showPassword'
                                    class="nav-link w-100 mb-3 d-flex align-items-center active" aria-current="page">
                                    <div class="avatar avatar-lg rounded bg-body-secondary flex-shrink-0">
                                        <i class="fi fi-rr-lock fs-3"></i>
                                    </div>
                                    <div class="ms-3">
                                        <h6>Password</h6>
                                        <p class="fs-13 fw-normal text-muted mb-0">
                                            Update password
                                        </p>
                                    </div>
                                    <div class="btn btn-icon btn-light ms-auto flex-shrink-0">
                                        <i class="fi fi-rr-angle-small-right"></i>
                                    </div>
                                </a>
                            </nav>
                            <!--! End:: settings-nav-items !-->
                        </div>
                        <!-- End:: edash-settings-aside -->

                        <!-- Start:: edash-settings-content -->
                        <div class="edash-settings-content card w-100 overflow-hidden">
                            <!--! Start:: settings-content-header !-->
                            <div
                                class="px-4 gap-3 d-flex align-items-center justify-content-between border-bottom min-ht-80">
                                <h2 class="fs-18 fw-semibold mb-0">
                                    @if ($basicMode)
                                        Profile
                                    @else
                                        Password
                                    @endif
                                </h2>
                                <div class="hstack gap-2 d-lg-none">
                                    <a wire:click='showBasic' class="btn btn-md btn-icon btn-light"
                                        data-bs-toggle="tooltip" data-bs-trigger="hover" title="Integrations Settings">
                                        <i class="fi fi-br-angle-left"></i>
                                    </a>
                                    <a wire:click='showPassword' class="btn btn-md btn-icon btn-light"
                                        data-bs-toggle="tooltip" data-bs-trigger="hover" title="Security Settings">
                                        <i class="fi fi-br-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <!--! End:: settings-content-header !-->
                            @if ($basicMode)
                                <div class="card-body">
                                    <form>

                                        <div class="  d-flex align-items-left justify-content-between  min-ht-80">
                                            <h2 class="fs-18 fw-semibold mb-0">Personal details</h2>
                                        </div>
                                        <!--! Start:: personal-info !-->
                                        {{-- Removed non-essential fields (account type, referral owner, etc.) --}}
                                        <div class="row g-4 mb-4">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted">First Name</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" wire:model='first_name'
                                                    @if (!$hasPermission) disabled @endif
                                                    placeholder="Firstname" />
                                            </div>
                                            @error('first_name')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        @if (false && $isAdmin)
                                            <div class="row g-4 mb-4">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted">Gender</label>
                                            </div>
                                            <div class="col-md-9">
                                                <select class="form-select" wire:model='gender'
                                                    @if (!$hasPermission) disabled @endif>
                                                    <option value="Male">Male
                                                    </option>
                                                    <option value="Female">Female
                                                    </option>

                                                </select>
                                            </div>
                                            @error('gender')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            </div>
                                            <div class="row g-4 mb-4">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted">Branch</label>
                                            </div>
                                            <div class="col-md-9">
                                                <select class="form-select" wire:model='customer_branch'
                                                    @if (!$hasPermission) disabled @endif>
                                                    <option value="Galle" @selected($customer_branch == 'Galle')>Galle
                                                    </option>
                                                    <option value="Malabe" @selected($customer_branch == 'Malabe')>Malabe
                                                    </option>
                                                    <option value="Panadura" @selected($customer_branch == 'Panadura')>Panadura
                                                    </option>
                                                    <option value="Nittambuwa" @selected($customer_branch == 'Nittambuwa')>Nittambuwa
                                                    </option>
                                                    <option value="Kurunegala" @selected($customer_branch == 'Kurunegala')>Kurunegala
                                                    </option>

                                                </select>
                                            </div>
                                            @error('customer_branch')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            </div>
                                        @endif

                                        <div class="row g-4 mb-4">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted">Last Name</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input @if (!$hasPermission) disabled @endif type="text"
                                                    class="form-control" wire:model='last_name'
                                                    placeholder="Lastname" />
                                            </div>
                                            @error('last_name')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row g-4 mb-4">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted">Registration Number</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input @if (!$hasPermission) disabled @endif
                                                    type="text" class="form-control" wire:model='reg_no'
                                                    placeholder="Registration Number" />
                                            </div>
                                            @error('reg_no')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row g-4 mb-4 d-none">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted">Username</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input @if (!$hasPermission) disabled @endif
                                                    class="form-control" wire:model='name' />
                                            </div>
                                            @error('name')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row g-4 mb-4">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted">Email</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text"
                                                    @if (!$hasPermission) disabled @endif
                                                    class="form-control" wire:model='email' />
                                            </div>
                                            @error('email')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row g-4 mb-4">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted">Phone</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text"
                                                    @if (!$hasPermission) disabled @endif
                                                    class="form-control" wire:model='mobile_no' />
                                            </div>
                                            @error('mobile_no')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        @if (false && $isAdmin)
                                            <div class="row g-4 mb-4">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted">Date of Birth</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input @if (!$hasPermission) disabled @endif
                                                    class="form-control" id="birthDatePicker" wire:model='dob' />
                                            </div>
                                            @error('dob')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            </div>
                                            <div class="row g-4 mb-4">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted">NIC</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input @if (!$hasPermission) disabled @endif
                                                    class="form-control" id="birthDatePicker" wire:model='nic' />
                                            </div>
                                            @error('nic')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            </div>

                                            <div class="row g-4 mb-4">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted">Address</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control mb-3"
                                                    @if (!$hasPermission) disabled @endif
                                                    placeholder="Address " wire:model='address' />

                                            </div>
                                            @error('address')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            </div>
                                        @endif
                                        @if ($hasPermission)
                                            <div class="row g-4 mb-4">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-9">
                                                    <button class="btn btn-primary" type="button"
                                                        @click.prevent="
                                                            if (typeof Swal === 'undefined') {
                                                                if (confirm('Are you sure you want to Save Personal Details?')) {
                                                                    $wire.savePersonal();
                                                                }
                                                                return;
                                                            }
                                                            Swal.fire({
                                                                title: 'Are you sure you want to Save Personal Details?',
                                                                icon: 'question',
                                                                showCancelButton: true,
                                                                confirmButtonText: 'Yes, save',
                                                                cancelButtonText: 'Cancel'
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    $wire.savePersonal();
                                                                }
                                                            });
                                                        ">
                                                        SAVE PERSONAL DETAILS
                                                    </button>
                                                </div>
                                            </div>
                                        @endif

                                        <!--! End:: address-info !-->
                                        @if (false)
                                            <hr class="my-12 border-top-dashed" />
                                        <div class="gap-3 d-flex align-items-left justify-content-between  min-ht-80">
                                            <h2 class="fs-18 fw-semibold mb-0">Bank details</h2>
                                        </div>
                                        <!--! Start:: bank-info !-->
                                        <div class="row g-4 mb-4">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted">Bank Name</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" wire:model='bank_name'
                                                    @if (!$bankEnabled) disabled @endif
                                                    placeholder="Bank Name" />
                                            </div>
                                            @error('bank_name')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row g-4 mb-4">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted">Branch</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input @if (!$bankEnabled) disabled @endif
                                                    type="text" class="form-control" wire:model='branch'
                                                    placeholder="Branch" />
                                            </div>
                                            @error('branch')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row g-4 mb-4">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted">Bank Holder Name</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input @if (!$bankEnabled) disabled @endif
                                                    placeholder="Bank Holder Name" class="form-control"
                                                    wire:model='holder_name' />
                                            </div>
                                            @error('holder_name')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row g-4 mb-4">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted">Account Number</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="number"
                                                    @if (!$bankEnabled) disabled @endif
                                                    class="form-control" wire:model='account_number'
                                                    placeholder="Account Number" />
                                            </div>
                                            @error('account_number')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        @if ($bankEnabled || $hasPermission)
                                            <div class="row g-4 mb-4">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-9">
                                                    <button class="btn btn-primary" type="button"
                                                        wire:click='saveBank()'
                                                        wire:confirm="Are you sure you want to Save Bank Details?">
                                                        SAVE BANK DETAILS
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                        <!--! End:: bank-info !-->
                                        <hr class="my-12 border-top-dashed" />
                                        <div class="gap-3 d-flex align-items-left justify-content-between  min-ht-80">
                                            <h2 class="fs-18 fw-semibold mb-0">Beneficiary details</h2>
                                        </div>
                                        <!--! Start:: benificiary-info !-->
                                        <div class="row g-4 mb-4">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted">Beneficiary Name</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"
                                                    wire:model='benificiary_name' placeholder="Beneficiary  Name" />
                                            </div>
                                            @error('benificiary_name')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row g-4 mb-4">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted">Beneficiary Relationship</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" wire:model='relationship'
                                                    placeholder="Beneficiary  Relationship" />
                                            </div>
                                            @error('relationship')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row g-4 mb-4">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted">Beneficiary Contact No</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input placeholder="Beneficiary  Contact No" class="form-control"
                                                    wire:model='benificiary_contact_no' type="number" />
                                            </div>
                                            @error('benificiary_contact_no')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-9">
                                            <button class="btn btn-primary" type="button"
                                                wire:click='saveBenificiary()'
                                                wire:confirm="Are you sure you want to Save Benificiary Details?">
                                                SAVE BENIFICIARY DETAILS
                                            </button>
                                        </div>
                                        <hr class="my-12 border-top-dashed" />
                                        <div class="gap-3 d-flex align-items-left justify-content-between  min-ht-80">
                                            <h2 class="fs-18 fw-semibold mb-0">Billing Details</h2>
                                        </div>
                                        <!--! Start:: benificiary-info !-->
                                        <div class="row g-4 mb-4">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted">First Name</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"
                                                    wire:model='billing_first_name' />
                                            </div>
                                            @error('billing_first_name')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row g-4 mb-4">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted">Last Name</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"
                                                    wire:model='billing_last_name' />
                                            </div>
                                            @error('billing_last_name')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row g-4 mb-4">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted">Street Address</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"
                                                    wire:model='street_addr' />
                                            </div>
                                            @error('street_addr')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row g-4 mb-4">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted">ZIP / Postal</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" wire:model='zip' />
                                            </div>
                                            @error('zip')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-9">
                                            <button class="btn btn-primary" type="button" wire:click='saveBilling()'
                                                wire:confirm="Are you sure you want to Save Benificiary Details?">
                                                UPDATE BILLING DETAILS
                                            </button>
                                        </div>

                                        <div class="row g-4 mb-4">
                                            <div class="col-md-3"></div>



                                            @if ($hasPermission)
                                                <!--! End:: benificiary-info !-->
                                                <hr class="my-12 border-top-dashed" />
                                                <div
                                                    class="gap-3 d-flex align-items-left justify-content-between  min-ht-80">
                                                    <h2 class="fs-18 fw-semibold mb-0">point details</h2>
                                                </div>
                                                <!--! Start:: benificiary-info !-->
                                                <div class="row g-4 mb-4">
                                                    <div class="col-md-3">
                                                        <label class="fw-semibold text-muted">Agent 1</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="number" class="form-control"
                                                            wire:model='left_points'
                                                            @if (!$hasPermission) disabled @endif
                                                            placeholder="Agent 1 points" />
                                                    </div>
                                                    @error('left_points')
                                                        <div style="color: red">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="row g-4 mb-4">
                                                    <div class="col-md-3">
                                                        <label class="fw-semibold text-muted">Agent 2</label>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="number" class="form-control"
                                                            wire:model='right_points'
                                                            @if (!$hasPermission) disabled @endif
                                                            placeholder="Agent 2 points" />
                                                    </div>
                                                    @error('right_points')
                                                        <div style="color: red">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            @endif

                                            @if ($hasPermission)
                                                <div class="row g-4 mb-4">
                                                    <div class="col-md-3"></div>
                                                    <div class="col-md-9">
                                                        <button class="btn btn-primary" type="button"
                                                            wire:click='updatePoints()'
                                                            wire:confirm="Are you sure you want to Update Point Details?">
                                                            UPDATE POINT DETAILS
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    </form>
                                </div>
                            @endif
                            @if ($passwordMode)
                                <div class="card-body">
                                    <form wire:submit="editPassword">


                                        <!--! Start:: password-info !-->
                                        <div class="row g-4 mb-4">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted">New Password</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="password" class="form-control" wire:model='password'
                                                    placeholder="New Password" />
                                            </div>
                                            @error('password')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row g-4 mb-4">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted">Confirm Password</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="password" class="form-control"
                                                    wire:model='confirm_password' placeholder="Confirm Password" />
                                            </div>
                                            @error('confirm_password')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <!--! End:: password-info !-->
                                        <hr class="my-12 border-top-dashed" />
                                        <!--! Start:: action-button !-->
                                        <div class="row g-4 mb-4">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-9">
                                                <a href="javascript:void(0);" wire:click='clearPasswords'
                                                    class="btn btn-light text-danger">Discard</a>
                                                <button class="btn btn-primary" type="submit"
                                                    wire:confirm="Are you sure you want to Submit?">
                                                    SAVE
                                                </button>
                                            </div>
                                        </div>
                                        <!--! End:: action-button !-->

                                    </form>
                                </div>
                            @endif

                            @if (false && $walletMode && $hasPermission)
                                <div class="card-body">
                                    <form wire:submit="editWallet">


                                        <!--! Start:: password-info !-->
                                        <div class="row g-4 mb-4">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted">Available Balance</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="number" disabled class="form-control"
                                                    wire:model='available_balance' />
                                            </div>

                                        </div>
                                        <div class="row g-4 mb-4">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted">Add / Remove</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control" wire:model='new_balance'
                                                    placeholder="Amount to Deduct" />
                                            </div>
                                            @error('new_balance')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row g-4 mb-4">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted">Reason</label>
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" wire:model='reason'
                                                    placeholder="Reason For Edit" />
                                            </div>
                                            @error('reason')
                                                <div style="color: red">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <!--! End:: password-info !-->
                                        <hr class="my-12 border-top-dashed" />
                                        <!--! Start:: action-button !-->
                                        <div class="row g-4 mb-4">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-9">
                                                <a href="javascript:void(0);" wire:click='clearPasswords'
                                                    class="btn btn-light text-danger">Discard</a>
                                                <button class="btn btn-primary" type="submit"
                                                    wire:confirm="Are you sure you want to Submit?">
                                                    SAVE
                                                </button>
                                            </div>
                                        </div>
                                        <!--! End:: action-button !-->

                                    </form>
                                </div>
                            @endif
                        </div>
                        <!-- End:: edash-settings-content  -->
                    </div>
                </div>
                <!--! End:: Content Section !-->
            </div>
            <!--! End:: Content Section !-->
        </div>
</div>
