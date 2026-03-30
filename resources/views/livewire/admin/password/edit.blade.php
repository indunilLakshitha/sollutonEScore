<div>
    <livewire:comp.breadcumb title="PASSWORD MANAGER" section="Admin" sub="Password" action="Update">
        <div>
            <!--! Start:: Content Section !-->
            <div class="edash-page-container container-xxl" id="edash-page-container">
                <!--! Start:: Content Section !-->
                <div class="edash-content-section">
                    <div class="d-flex gap-3 gap-md-4">

                        <!-- End:: edash-settings-aside -->
                        <!-- Start:: edash-settings-content -->
                        <div class="edash-settings-content card w-100 overflow-hidden">
                            <!--! Start:: settings-content-header !-->
                            <!--! End:: settings-content-header !-->
                            <div class="card-body">
                                <div class="col-6">
                                    @if (session()->has('message'))
                                        <div class="alert alert-success">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                </div>
                                <form wire:submit="updateComissionPassword">


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
                                            <input type="password" class="form-control" wire:model='confirm_password'
                                                placeholder="Confirm Password" />
                                        </div>
                                        @error('confirm_password')
                                            <div style="color: red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <hr class="my-12 border-top-dashed" />
                                    <!--! Start:: action-button !-->
                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-9">
                                            <a href="{{ route('admin.pasword.list') }}"
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
