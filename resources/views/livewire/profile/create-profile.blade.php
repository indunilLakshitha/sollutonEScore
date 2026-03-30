<div>
    <livewire:comp.breadcumb title="PROFILE" section="User" sub="Profile" action="Create">
    <div>
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
                            <a href="./settings-account.html"
                                class="nav-link w-100 mb-3 d-flex align-items-center active" aria-current="page">
                                <div class="avatar avatar-lg rounded bg-body-secondary flex-shrink-0">
                                    <i class="fi fi-rr-tags fs-3"></i>
                                </div>
                                <div class="ms-3">
                                    <h6>Account</h6>
                                    <p class="fs-13 fw-normal text-muted mb-0">
                                         Name &amp; Bank Details
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
                            <h2 class="fs-18 fw-semibold mb-0">Account</h2>
                            <div class="hstack gap-2 d-lg-none">
                                <a href="./settings-integration.html" class="btn btn-md btn-icon btn-light"
                                    data-bs-toggle="tooltip" data-bs-trigger="hover" title="Integrations Settings">
                                    <i class="fi fi-br-angle-left"></i>
                                </a>
                                <a href="./settings-security.html" class="btn btn-md btn-icon btn-light"
                                    data-bs-toggle="tooltip" data-bs-trigger="hover" title="Security Settings">
                                    <i class="fi fi-br-angle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!--! End:: settings-content-header !-->
                        <div class="card-body">
                            <form wire:submit="saveProfile">
                                <!--! Start:: profile-avatar !-->
                                {{-- <div class="row g-4">
                                    <div class="col-md-3">
                                        <label class="fw-semibold text-muted">Avatar</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div
                                            class="wd-100 ht-100 position-relative overflow-hidden border border-gray-2 rounded cursor-pointer">
                                            <img src="./../assets/images/avatar/1.png"
                                                class="upload-pic img-fluid rounded h-100 w-100" alt="" />
                                            <div
                                                class="position-absolute start-50 top-50 end-0 bottom-0 translate-middle h-100 w-100 hstack align-items-center justify-content-center cursor-pointer upload-button">
                                                <i class="fi fi-rr-camera" aria-hidden="true"></i>
                                            </div>
                                            <input class="file-upload" type="file" accept="image/*" />
                                        </div>
                                    </div>
                                </div> --}}
                                <!--! End:: profile-avatar !-->
                                <hr class="my-12 border-top-dashed" />
                                <!--! Start:: personal-info !-->
                                <div class="row g-4 mb-4">
                                    <div class="col-md-3">
                                        <label class="fw-semibold text-muted">First Name</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" wire:model='first_name'
                                            @if (!$hasPermission) disabled @endif placeholder="Firstname" />
                                    </div>
                                    @error('first_name')
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
                                        <input @if (!$hasPermission) disabled @endif type="text"
                                            class="form-control" wire:model='last_name' placeholder="Lastname" />
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
                                        <input @if (!$hasPermission) disabled @endif type="text"
                                            class="form-control" wire:model='reg_no' placeholder="Registration Number" />
                                    </div>
                                    @error('reg_no')
                                        <div style="color: red">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row g-4 mb-4">
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
                                        <input type="text" class="form-control" wire:model='email' />
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
                                        <input type="text" class="form-control" wire:model='mobile_no' />
                                    </div>
                                    @error('mobile_no')
                                        <div style="color: red">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="row g-4 mb-4">
                                    <div class="col-md-3">
                                        <label class="fw-semibold text-muted">Date of Birth</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input @if (!$hasPermission) disabled @endif class="form-control"
                                            id="birthDatePicker" wire:model='dob' />
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
                                        <input class="form-control" id="birthDatePicker" wire:model='nic' />
                                    </div>
                                    @error('nic')
                                        <div style="color: red">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!--! End:: personal-info !-->
                                <hr class="my-12 border-top-dashed" />
                                <!--! Start:: address-info !-->
                                <div class="row g-4 mb-4">
                                    <div class="col-md-3">
                                        <label class="fw-semibold text-muted">Address</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control mb-3" placeholder="Address "
                                            wire:model='address' />

                                    </div>
                                    @error('address')
                                        <div style="color: red">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!--! End:: address-info !-->
                                <hr class="my-12 border-top-dashed" />

                                <!--! Start:: bank-info !-->
                                <div class="row g-4 mb-4">
                                    <div class="col-md-3">
                                        <label class="fw-semibold text-muted">Bank Name</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" wire:model='bank_name'
                                            @if (!$hasPermission) disabled @endif
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
                                        <input @if (!$hasPermission) disabled @endif type="text"
                                            class="form-control" wire:model='branch' placeholder="Branch" />
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
                                        <input @if (!$hasPermission) disabled @endif
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
                                        <input type="number" @if (!$hasPermission) disabled @endif
                                            class="form-control" wire:model='account_number'
                                            placeholder="Account Number" />
                                    </div>
                                    @error('account_number')
                                        <div style="color: red">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <!--! End:: bank-info !-->
                                <hr class="my-12 border-top-dashed" />

                                <!--! Start:: benificiary-info !-->
                                <div class="row g-4 mb-4">
                                    <div class="col-md-3">
                                        <label class="fw-semibold text-muted">Beneficiary Name</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" wire:model='benificiary_name'
                                            @if (!$hasPermission) disabled @endif
                                            placeholder="Beneficiary  Name" />
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
                                        <input @if (!$hasPermission) disabled @endif type="text"
                                            class="form-control" wire:model='relationship'
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
                                        <input @if (!$hasPermission) disabled @endif
                                            placeholder="Beneficiary  Contact No" class="form-control"
                                            wire:model='benificiary_contact_no' />
                                    </div>
                                    @error('benificiary_contact_no')
                                        <div style="color: red">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!--! End:: benificiary-info !-->


                                <hr class="my-12 border-top-dashed" />
                                <!--! Start:: action-button !-->
                                <div class="row g-4 mb-4">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-9">
                                        <a href="javascript:void(0);" wire:click='clear'
                                            class="btn btn-light text-danger">Discard</a>
                                        <button class="btn btn-primary" type="submit">
                                            SAVE
                                        </button>
                                    </div>
                                </div>
                                <!--! End:: action-button !-->

                            </form>
                        </div>
                    </div>
                    <!-- End:: edash-settings-content  -->
                </div>
            </div>
            <!--! End:: Content Section !-->
        </div>
        <!--! End:: Content Section !-->
    </div>
</div>
