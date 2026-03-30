<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="Direct Team" section="User" sub="My Team" action="Direct Team">
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
                                            <label class="form-label">Account Type:</label>
                                            <select class="form-select" wire:model='type' wire:change="filter()">
                                                <option value="0">ALL</option>
                                                <option value="1" selected>Main Account</option>
                                                <option value="2">Dummy Account</option>
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
                            <h4 class="card-title">Direct Team</h4>
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
                                    <th>User Id</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Contact No</th>

                                    <th>Agency</th>
                                    <th>Account Created</th>
                                    <th>Account Status</th>
                                    {{-- <th>ACTION</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $user->id }}</td>
                                        <td></td>
                                        <td>
                                            @if ($user->type == 'M')
                                                <h6 class="main-color">MAIN</h6>
                                            @elseif ($user->type == 'A1')
                                                <h6 class="dummy-color">DUMMY</h6>
                                            @elseif ($user->type == 'A2')
                                                <h6 class="dummy-color">DUMMY</h6>
                                            @endif
                                        </td>
                                        <td>{{ $user->mobile_no }}</td>
                                        <td>{{ $user->assigned_user_id . ' - ' . $user->assigned_user_side }}</td>

                                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('Y m d') }}</td>
                                        <td>
                                            @if ($user->er_status == '1')
                                                NONE
                                            @elseif($user->er_status == '2')
                                                <h6 class="half-color">HALF</h6>
                                            @elseif($user->er_status == '3')
                                                <h6 class="full-color">FULL</h6>
                                            @elseif($user->er_status == '4')
                                                <h6 class="er-color">ER</h6>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>User Id</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Contact No</th>
                                    <th>Path</th>

                                    <th>Account Created</th>
                                    <th>Account Status</th>
                                    {{-- <th>ACTION</th> --}}
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End:: Zero Config -->
        </div>

        <style>
            .er-color {
                color: green;
            }

            .full-color {
                color: rgb(23, 136, 211);
            }

            .half-color {
                color: rgb(23, 36, 211);
            }
        </style>
</div>
