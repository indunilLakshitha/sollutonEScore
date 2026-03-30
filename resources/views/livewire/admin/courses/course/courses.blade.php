<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="COURSES" section="Admin" sub="Courses" action="All">
        <!--! End:: Breadcumb !-->
        <div class="edash-content-section row g-3 g-md-4">
            <!-- Start:: Filter -->
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <!--  -->
                        <form action="#" class="form-group" id="repeaterAdvanced">
                            <div data-repeater-list="repeater-advanced">
                                <div data-repeater-item>
                                    <div class="form-group row mb-4">

                                        <div class="col-lg-2 mb-2 mb-md-0">
                                            <label class="form-label">Category:</label>
                                            <select class="form-select" wire:model='selected_category'
                                                wire:change='filter()'>
                                                <option value="0">ALL</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->cat_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        {{-- <div class="col-lg-2 mb-2 mb-md-0 pt-1">
                                            <a href="javascript:void(0);" wire:click='filter()'
                                                class="btn btn-md btn-soft-danger d-block mt-4">

                                                <span class="ms-2">SEARCH</span>
                                            </a>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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
                            <h4 class="card-title">Courses</h4>
                        </div>
                        <div class="card-header">
                            <a href="{{ route('admin.course.create') }}" class="btn btn-md btn-primary">ADD</a>
                        </div>
                    </div>
                    <div class="card-table table-responsive">
                        <table id="zeroConfig" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Thumbnail</th>
                                    <th>Price</th>
                                    <th>Points</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr>
                                        <td>{{ $course->id }}</td>
                                        <td>{{ $course->category?->cat_name }}</td>
                                        <td>{{ $course->name }}</td>
                                        <td> <img style="width : 100px;"
                                                src="{{ asset('storage/' . $course->thumbnail) }}"></td>
                                        <td>{{ number_format($course->course_price, 2) }}</td>
                                        <td>{{ $course->course_point }}</td>

                                        <td>
                                            <a class="btn btn-primary"
                                                href="{{ route('admin.course.edit', $course->id) }}" type="button">
                                                EDIT
                                            </a>

                                            <button class="btn btn-danger" wire:click='delete({{ $course->id }})'
                                                wire:confirm="Are you sure you want to Delete this Course?"
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
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>Thumbnail</th>
                                    <th>Price</th>
                                    <th>Points</th>
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
