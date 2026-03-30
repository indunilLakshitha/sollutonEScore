<div>
    <livewire:comp.breadcumb title="COURSES" section="Admin" sub="Courses" action="Category Add">
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
                                <form wire:submit="saveCategory">


                                    <div class="row g-4 mb-4 mt-5">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted">Category Name</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" wire:model='cat_name'
                                                placeholder="Category Name" />
                                        </div>
                                        @error('cat_name')
                                            <div style="color: red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="row g-4 mb-4 mt-5">
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
