<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="Pending Activation" section="User" sub="My Team" action="Pending Activation">
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
                            <h4 class="card-title">Pending Activation</h4>
                        </div>
                        <div class="card-header">
                            {{-- <a href="{{ route('admin.customer.create') }}" class="btn btn-md btn-primary">ADD</a> --}}
                        </div>
                    </div>
                    <div class="card-table table-responsive">

                        <table id="zeroConfig" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Reg No</th>
                                    <th>Referer</th>
                                    <th>Path</th>
                                    <th>Reg Date</th>
                                    <th>Contact No</th>
                                    <th>Status</th>
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
                                        <td>{{ $user->mobile_no }}</td>
                                        @if ($user->er_status == 1)
                                            <td> <button class=" btn btn-warning"> Not Activated</button></td>
                                        @elseif ($user->er_status == 2)
                                            <td> <button class=" btn btn-facebook"> Half Activated</button></td>
                                        @elseif ($user->er_status == 3)
                                            <td> <button class=" btn btn-primary"> Full Activated</button></td>
                                        @elseif ($user->er_status == 4)
                                            <td> <button class=" btn btn-success"> ER Activated</button></td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td data-bs-toggle="tooltip" data-bs-trigger="hover"
                                            title="{{ $user->course_name }}">
                                            @if (strlen($user->course_name) > 15)
                                                {{ substr($user->course_name, 0, 21) }}...
                                            @else
                                                {{ $user->course_name }}
                                            @endif

                                        </td>
                                        <td>

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
                                    <th>Path</th>
                                    <th>Reg Date</th>
                                    <th>Contact No</th>
                                    <th>Status</th>
                                    <th>Selected Course</th>
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
                document.getElementById("halfBtn").click();

            } else if (result.isDenied) {
                document.getElementById("fullBtn").click();
            }
        });
    });

    function changeCourse(div, userId) {
        var courseId = document.getElementById(div).value;
        document.getElementById('text_div_id' + userId).value = courseId;
        document.getElementById('btn' + userId).click();

    }
</script>
