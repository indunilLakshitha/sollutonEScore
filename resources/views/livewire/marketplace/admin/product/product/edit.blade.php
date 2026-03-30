<div>
    <livewire:comp.breadcumb title="PRODUCT" section="Admin" sub="Product" action="Product Edit">
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
                                <form wire:submit="saveProduct">


                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted">Name</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" wire:model='title'
                                                placeholder="Prouct Title" />
                                        </div>
                                        @error('title')
                                            <div style="color: red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted">Slug</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" wire:model='slug'
                                                placeholder="Slug" />
                                        </div>
                                        @error('slug')
                                            <div style="color: red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted">Sku</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" wire:model='sku'
                                                placeholder="SKU" />
                                        </div>
                                        @error('sku')
                                            <div style="color: red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted">Category</label>
                                        </div>
                                        <div class="col-lg-2 mb-2 mb-md-0">
                                            <select class="form-select" wire:model='category_id'
                                                wire:change='setSubCategory'>
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
                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted">Sub Category</label>
                                        </div>
                                        <div class="col-lg-2 mb-2 mb-md-0">
                                            <select class="form-select" wire:model='sub_category_id'>
                                                <option class="d-none">--select--</option>
                                                @foreach ($allSubCategories as $cat)
                                                    <option value="{{ $cat->id }}">
                                                        {{ $cat->name }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>
                                        @error('sub_category_id')
                                            <div style="color: red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted">Brand</label>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="row">
                                                {{-- <select class="form-select" wire:model='brand_id'>
                                                    <option class="d-none">--Select Brand Name--</option>
                                                    @foreach ($allBrands as $brand)
                                                        <option value="">
                                                            {{ $brand->name }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                                <p class="mt-3"> OR</p> --}}
                                                <input type="text" class="form-control "
                                                    placeholder="Enter Brand Name" wire:input='getBrandBySearch()'
                                                    wire:model='brand_keyword' />

                                                <div class="panel-footer ">
                                                    <ul class="list-group cus-list ">
                                                        @foreach ($filteredBrands as $b)
                                                            <li class="list-group-item "
                                                                wire:click='setBrand({{ $b }})'>
                                                                {{ $b->name }}
                                                            </li>
                                                        @endforeach

                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                        @error('brand_keyword')
                                            <div style="color: red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted">Size</label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">
                                                <div class="col">
                                                    <button type="button" wire:click='addSizes()'
                                                        class="btn btn-primary">ADD</button>
                                                </div>
                                                <div class="col"></div>
                                                <div class="col">
                                                </div>

                                            </div>
                                            @foreach ($sizes as $key => $size)
                                                <div class="row mt-2">

                                                    <div class="col"><input type="text" class="form-control"
                                                            wire:model='sizes.{{ $key }}.name'
                                                            placeholder="Size {{ $key + 1 }}" />
                                                        @error('sizes.' . $key . '.name')
                                                            <div style="color: red">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <input type="number" placeholder="Price"
                                                            wire:model='sizes.{{ $key }}.price'
                                                            class="form-control" />
                                                        @error('sizes.' . $key . '.price')
                                                            <div style="color: red">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <button type="button"
                                                            wire:click='removeSizes({{ $size['id'] }})'
                                                            class="btn btn-danger"> <i
                                                                class="fi fi-rr-trash"></i></button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted">Available Colors</label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row">


                                                <div class="col">
                                                    <button type="button" wire:click='addColors()'
                                                        class="btn btn-primary">ADD</button>
                                                </div>
                                                <div class="col">

                                                </div>

                                            </div>
                                            @foreach ($colors as $key => $color)
                                                <div class="row mt-2">
                                                    <div class="col"><input type="text" class="form-control"
                                                            wire:model='colors.{{ $key }}.name'
                                                            placeholder="Name" />
                                                        @error('colors.' . $key . '.name')
                                                            <div style="color: red">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>

                                                    <div class="col">
                                                        <input type="color" class="form-control"
                                                            wire:model='colors.{{ $key }}.code'
                                                            placeholder="Color" />
                                                        @error('colors.' . $key . '.code')
                                                            <div style="color: red">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col">
                                                        <button type="button"
                                                            wire:click='removeColors({{ $color['id'] }})'
                                                            class="btn btn-danger"> <i
                                                                class="fi fi-rr-trash"></i></button>
                                                    </div>

                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted">Old Price</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" wire:model='old_price'
                                                placeholder="Old Price" />
                                        </div>
                                        @error('old_price')
                                            <div style="color: red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row g-4 mb-4 ">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted"> Price</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" wire:model='price'
                                                placeholder="Price" />
                                        </div>
                                        @error('price')
                                            <div style="color: red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted"> Direct Comission</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control"
                                                wire:model='referrer_comission' placeholder="Direct Comission" />
                                        </div>
                                        @error('referrer_comission')
                                            <div style="color: red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted"> Item Points</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" class="form-control" wire:model='item_points'
                                                placeholder="Item Points" />
                                        </div>
                                        @error('item_points')
                                            <div style="color: red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted"> Short Desription</label>
                                        </div>
                                        <div class="col-md-9" wire:ignore>
                                            <textarea name="summernoteBasic2" id="summernoteBasic2">{!! $short_description !!}</textarea>
                                            <textarea class="d-none" id="short_description_text" wire:model.lazy='short_description_text'></textarea>

                                        </div>

                                        @error('short_description_text')
                                            <div style="color: red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted">Description</label>
                                        </div>
                                        <div class="col-md-9" wire:ignore>
                                            <textarea name="summernoteBasic" id="summernoteBasic">{!! $description !!}</textarea>
                                            <textarea class="d-none" id="description_text" wire:model.lazy='description_text'></textarea>

                                        </div>
                                        @error('description_text')
                                            <div style="color: red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted">Thumbnail</label>

                                        </div>
                                        <div class="col-md-9">

                                            <input type="file" class="form-control" wire:model='images' />
                                            @if ($images)
                                                <div class="col-md-9 mt-2">
                                                    @foreach ($images as $image)
                                                        <img style="width : 100px;"
                                                            src="{{ $image->temporaryUrl() }}">
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col-md-9 mt-2 ">
                                            @foreach ($currentImages as $currentImage)
                                                <div class="col ">

                                                    <img style="width : 100px;"
                                                        src="{{ asset('storage/' . $currentImage->image_name) }}">
                                                </div>
                                            @endforeach
                                        </div>


                                        @error('thumbnail')
                                            <div style="color: red">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
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
<script>
    function getContent(contents) {
        @this.set('description_text', contents)
    }

    function getContent2(contents) {
        @this.set('short_description_text', contents)
    }
</script>
