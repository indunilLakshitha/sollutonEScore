<div>
    <livewire:comp.breadcumb title="DISCOUNT CODE" section="Admin" sub="Product" action="Discount Code Add">
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
                                <form wire:submit="saveCode">
                                    <div class="row g-4  mt-5">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted"> Name</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" wire:model='name'
                                                placeholder=" Name" />
                                        </div>
                                        @error('name')
                                            <div style="color: red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row g-4 mt-5">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted"> Code</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" wire:model='code'
                                                placeholder=" Code" />
                                        </div>
                                        @error('code')
                                            <div style="color: red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row g-4 mt-5">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted">Type</label>
                                        </div>
                                        <div class="col-lg-2 mb-2 mb-md-0">
                                            <select class="form-select" wire:model='type'>
                                                <option class="d-none">--select--</option>
                                                <option value="percentage">
                                                    PERCENTAGE
                                                </option>
                                                <option value="fixed">
                                                    FIXED
                                                </option>

                                            </select>

                                        </div>
                                        @error('type')
                                            <div style="color: red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="row g-4 mt-5">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted">Amount</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" wire:model='percent_amount'
                                                placeholder="Amount" />
                                        </div>
                                        @error('percent_amount')
                                            <div style="color: red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row g-4 mt-5">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted">Expire Date</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="date" class="form-control" wire:model='expire_date'
                                                placeholder="expire_date" />
                                        </div>
                                        @error('expire_date')
                                            <div style="color: red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="row g-4 mt-5">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-9">
                                            <a href="javascript:void(0);" wire:click='Discard'
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
