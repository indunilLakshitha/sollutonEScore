<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="CATEGORIES" section="Admin" sub="Product" action="Categories">
        <!--! End:: Breadcumb !-->
        <div class="edash-content-section row g-3 g-md-4">
            <!-- Start:: Filter -->

            <!-- End:: Filter -->
            <div class="col-6">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
            <!-- Start:: Zero Config -->
            <div class="col-12">
                <div class="card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="card-header">
                            <h4 class="card-title">Categories</h4>
                        </div>
                        <div class="card-header">
                            <a class="btn btn-primary" href="{{ route('marketplace.admin.subCategory.create') }}"
                                type="button">
                                ADD SUB CATEGORY
                            </a>
                            <a href="{{ route('marketplace.admin.category.create') }}"
                                class="btn btn-md btn-primary">ADD CATEGORY</a>
                        </div>
                    </div>
                    <div class="card-table table-responsive">
                        <table id="zeroConfig" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Sub</th>

                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>
                                            @foreach ($category->sub as $sub)
                                                <button type="button" class="btn rounded-pill btn-primary mt-2"
                                                    wire:click='removeSub({{ $sub->id }})' type="button">
                                                    <i class="fi fi-rr-trash"></i>
                                                    <span class="ms-2">{{ $sub->name }}</span>
                                                </button>
                                            @endforeach
                                        </td>


                                        <td>

                                            <a class="btn btn-primary"
                                                href="{{ route('marketplace.admin.category.edit', $category->id) }}"
                                                type="button">
                                                EDIT
                                            </a>
                                            <button class="btn btn-danger" wire:click='delete({{ $category->id }})'
                                                wire:confirm="Are you sure you want to Delete this Category?"
                                                type="button">
                                                DELETE
                                            </button>
                                        </td>

                                    </tr>
                                @endforeach


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Sub</th>

                                    <th>ACTION</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End:: Zero Config -->
        </div>
</div>
