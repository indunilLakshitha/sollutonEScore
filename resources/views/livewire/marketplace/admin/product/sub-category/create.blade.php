<div>
    <livewire:comp.breadcumb title="CATEGORIES" section="Admin" sub="Product" action="Categories Add">
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
                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted">Category</label>
                                        </div>
                                        <div class="col-lg-2 mb-2 mb-md-0">
                                            <select class="form-select" wire:model='category_id'
                                                >
                                                <option class="d-none">--select--</option>
                                                @foreach ($allCategories as $cat)
                                                    <option value="{{ $cat->id }}">
                                                        {{ $cat->name }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>
                                        @error('category_id')
                                            <div style="color: red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="row g-4 mb-4 mt-5">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted">Sub Category Name</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" wire:model='name'
                                                placeholder="Category Name" />
                                        </div>
                                        @error('name')
                                            <div style="color: red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row g-4 mb-4 mt-5">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted">Slug</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" wire:model='slug'
                                                placeholder="Category Slug" />
                                        </div>
                                        @error('slug')
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
