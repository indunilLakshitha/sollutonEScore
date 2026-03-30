<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="COURSES" section="Admin" sub="Courses" action="Categories">
        <!--! End:: Breadcumb !-->
        <div class="edash-content-section row g-3 g-md-4">
            <!-- Start:: Filter -->
            {{-- <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <!--  -->
                        <form action="#" class="form-group" id="repeaterAdvanced">
                            <div data-repeater-list="repeater-advanced">
                                <div data-repeater-item>
                                    <div class="form-group row mb-4">

                                        <div class="col-lg-2 mb-2 mb-md-0">
                                            <label class="form-label">Course Category:</label>
                                            <select class="form-select">
                                                <option>--select--</option>
                                                <option value="">*</option>
                                                <option value="">Unblocked</option>
                                                <option value="">Blocked</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-2 mb-2 mb-md-0 pt-1">
                                            <a href="javascript:void(0);"
                                                class="btn btn-md btn-soft-danger d-block mt-4">

                                                <span class="ms-2">SEARCH</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> --}}
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
                            <a href="{{ route('admin.course.category.create') }}" class="btn btn-md btn-primary">ADD</a>
                        </div>
                    </div>
                    <div class="card-table table-responsive">
                        <table id="zeroConfig" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>

                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->cat_name }}</td>


                                        <td>
                                            <a class="btn btn-primary"
                                                href="{{ route('admin.course.category.edit', $category->id) }}"
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
