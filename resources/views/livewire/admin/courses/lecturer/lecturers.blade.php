<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="LECTURER" section="Admin" sub="Courses" action="Lecturers">
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
                            <h4 class="card-title">Lecturers</h4>
                        </div>
                        <div class="input-group ms-auto w-25 me-3">
                            <span class="input-group-text"><i class="fi fi-rr-search"></i></span>
                            <input type="text" class="form-control" wire:model='search'
                                wire:input='filter' wire:change='filter()' placeholder="Search here...">
                        </div>
                        <div class="card-header">
                            <a href="{{ route('admin.course.lecturer.create') }}" class="btn btn-md btn-primary">ADD</a>
                        </div>
                    </div>
                    <div class="card-table table-responsive">
                        <table id="" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Post</th>
                                    <th>Image</th>

                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lecturers as $lecture)
                                    <tr>
                                        <td>{{ $lecture->id }}</td>
                                        <td>{{ $lecture->name }}</td>
                                        <td>{{ $lecture->post }}</td>
                                        <td><img style="width : 100px;" src="{{ asset('storage/' . $lecture->image) }}">
                                        </td>


                                        <td>
                                            <a class="btn btn-primary"
                                                href="{{ route('admin.course.lecturer.edit', $lecture->id) }}"
                                                type="button">
                                                EDIT
                                            </a>
                                            <button class="btn btn-danger" wire:click='delete({{ $lecture->id }})'
                                                wire:confirm="Are you sure you want to Delete this Lecturer?"
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
                                    <th>Post</th>
                                    <th>Image</th>

                                    <th>ACTION</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div id="pg_id">

                        {{ $lecturers->links() }}
                    </div>
                </div>
            </div>
            <!-- End:: Zero Config -->
        </div>
        <style>
            .main-color {
                color: green
            }

            .dummy-color {
                color: orange
            }

            #pg_id nav svg {
                width: 20px !important;
            }

            #pg_id nav .flex {
                display: none;
            }

            #pg_id nav .hidden {
                display: flex !important;
                align-items: center;
                column-gap: 15px;
                margin-top: 10px;
                padding: 20px;

            }

            #pg_id nav .hidden p {
                margin: 0px;
            }
        </style>
</div>
