<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="CUSTOMERS" section="Admin" sub="Customers" action="Pending">
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
                                            <label class="form-label">Course:</label>
                                            <select class="form-select" wire:model='selected_course'
                                                wire:change='filter()'>
                                                <option value="0">ALL</option>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{-- <div class="col-lg-2 mb-2 mb-md-0 pt-1">
                                            <button class="btn btn-md btn-soft-danger d-block mt-4"
                                                wire:click="filter()">

                                                <span class="ms-2">SEARCH</span>
                                            </button>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <!--  -->
                        <form action="#" class="form-group" id="repeaterAdvanced">
                            <div class="form-group row ">

                                <div class="col-lg-2 mb-2 mb-md-0">
                                    <label class="form-label">Not Activated:</label>
                                    <button class="w-25 btn btn-warning"> </button>
                                </div>
                                <div class="col-lg-2 mb-2 mb-md-0">
                                    <label class="form-label">Half Activated:</label>
                                    <button class="w-25 btn btn-facebook"> </button>
                                </div>
                                <div class="col-lg-2 mb-2 mb-md-0">
                                    <label class="form-label">Full Activated:</label>
                                    <button class="w-25 btn btn-primary"> </button>
                                </div>
                                <div class="col-lg-2 mb-2 mb-md-0">
                                    <label class="form-label">CRP Activated:</label>
                                    <button class="w-25 btn btn-success"> </button>
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
                            <h4 class="card-title">Customers Not Approved</h4>
                        </div>
                        <div class="card-header">
                            {{-- <a href="{{ route('admin.customer.create') }}" class="btn btn-md btn-primary">ADD</a> --}}
                        </div>
                        <div class="input-group ms-auto w-25 me-3">
                            <span class="input-group-text"><i class="fi fi-rr-search"></i></span>
                            <input type="text" class="form-control" wire:model='search'
                                wire:input='filter' wire:change='filter()' placeholder="Search here...">
                        </div>

                    </div>
                    <div class="card-table table-responsive">

                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Reg No</th>
                                    <th>Referer</th>
                                    <th>Assigned To</th>
                                    <th>Reg Date</th>
                                    <th>Selected Course</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td></td>
                                        <td>{{ $user->reg_no }}</td>
                                        <td>{{ $user->referrer?->reg_no }}</td>
                                        <td>{{ $user->assigned_user_id_on_approval . ' ' . $user->assigned_user_side_on_approval }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('Y m d') }}</td>

                                        <td><select class="form-select"
                                                wire:model="user_selected_courses.{{ $user->id }}"
                                                id="{{ $user->id }}" required
                                                wire:change='changeCourseOfUser({{ $user->id }})'>
                                                <option value="">
                                                    {{ $user->course_name }}
                                                </option>
                                                @foreach ($courses as $course)
                                                    <option value="{{ $course->id }}"
                                                        class="{{ $user->course_id == $course->id ? 'd-none' : ' ' }}">
                                                        {{ $course->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                        </td>
                                        <td>
                                            <button class="btn btn-primary" id="{{ 'btn' . $user->id }}"
                                                wire:click='setStatus({{ $user->id }})' type="button">
                                                APPROVE
                                            </button>
                                            <button class="btn btn-danger d-none" id="halfBtn"
                                                wire:click='setStatusType(2)' type="hidden">
                                                HALF
                                            </button>
                                            <button class="btn btn-danger d-none" id="fullBtn"
                                                wire:click='setStatusType(3)' type="hidden">
                                                FULL
                                            </button>
                                            <button class="btn btn-danger d-none" id="erBtn"
                                                wire:click='setStatusType(4)' type="hidden">
                                                ER
                                            </button>
                                            <button class="btn btn-danger" wire:click='delete({{ $user->id }})'
                                                wire:confirm="Are you sure you want to Delete this customer?"
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
                                    <th>Reg No</th>
                                    <th>Referer</th>
                                    <th>Assigned To</th>
                                    <th>Reg Date</th>
                                    <th>Selected Course</th>
                                    <th>ACTION</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div id="pg_id">

                        {{ $customers->links() }}
                    </div>
                </div>
            </div>
            <!-- End:: Zero Config -->
        </div>
        <style>
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

            .card-table .table thead tr th:nth-child(7) {
                min-width: 400px;

            }
            .card-table .table thead tr th:nth-child(2) {
                max-width: 150px;

            }
        </style>
</div>

<script>
    window.addEventListener('select_alert', function(e) {

        Swal.fire({
            title: "Approved As ...",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "HALF",
            denyButtonText: `FULL`
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Are you sure approve as HALF Paid?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, approve it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById("halfBtn").click();
                    }
                });


            } else if (result.isDenied) {
                Swal.fire({
                    title: "Are you sure to approve as FULL Paid? ",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, approve it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById("fullBtn").click();
                    }
                });
            }
        });
    });

    function changeCourse(div, userId) {
        var courseId = document.getElementById(div).value;
        document.getElementById('text_div_id' + userId).value = courseId;
        document.getElementById('btn' + userId).click();

    }
</script>
