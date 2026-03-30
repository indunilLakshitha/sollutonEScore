<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="PENDING COURSES" section="Admin" sub="Customers" action="Pending Courses">
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
                                        <div class="col-lg-2 mb-2 mb-md-0">
                                            <label class="form-label">Payment Percent:</label>
                                            <select class="form-select" wire:model='percent' wire:change='filter()'>
                                                <option value="0">ALL</option>
                                                <option value="2">HALF</option>
                                            </select>
                                        </div>

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
                            <h4 class="card-title">Courses Not Approved</h4>
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

                        <table id="" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Course Name</th>
                                    <th>Reg No</th>
                                    <th>Referer</th>
                                    <th>Date</th>
                                    <th>Contact No</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($requessts as $course)
                                    <tr>
                                        <td>{{ $course->id }}</td>
                                        <td>{{ $course->course->name }}</td>
                                        <td>{{ $course->user->reg_no }}</td>
                                        <td>{{ $course->user->referrer?->reg_no }}</td>

                                        <td>{{ \Carbon\Carbon::parse($course->created_at)->format('Y m d') }}</td>
                                        <td>{{ $course->user->mobile_no }}</td>


                                        <td>
                                            @if (!isset($course->approved_at))
                                                <button class="btn btn-primary" id="{{ 'btn' . $course->id }}"
                                                    wire:click='setStatus({{ $course->id }})' type="button">
                                                    APPROVE
                                                </button>
                                            @endif
                                            @if (isset($course->approved_at) && $course->purchased_percent == 1)
                                                <button class="btn btn-primary" id="{{ 'btn' . $course->id }}"
                                                    wire:click='setStatusForHalf({{ $course->id }})' type="button">
                                                    PAY FULL
                                                </button>
                                            @endif
                                            <button class="btn btn-danger d-none" id="halfBtn"
                                                wire:click='setStatusType(1)' type="hidden">
                                                HALF
                                            </button>
                                            <button class="btn btn-danger d-none" id="fullBtn"
                                                wire:click='setStatusType(2)' type="hidden">
                                                FULL
                                            </button>

                                            <button class="btn btn-danger" wire:click='delete({{ $course->id }})'
                                                wire:confirm="Are you sure you want to Delete This?" type="button">
                                                DELETE
                                            </button>

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <th>No</th>
                                <th>Course Name</th>
                                <th>Reg No</th>
                                <th>Referer</th>
                                <th>Date</th>
                                <th>Contact No</th>
                                <th>ACTION</th>
                            </tfoot>
                        </table>
                    </div>
                    <div id="pg_id">

                        {{ $requessts->links() }}
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
    window.addEventListener('select_alert_half_paid', function(e) {

        Swal.fire({
            title: "Approved As Full",
            showCancelButton: true,
            confirmButtonText: "APPROVE",
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Are you sure approve as FULL Paid?",
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
