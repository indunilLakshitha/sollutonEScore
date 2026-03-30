<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="Direct Team" section="Admin" sub="User" action="Direct Team">
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
                                            <label class="form-label">Users:</label>
                                            <select class="form-select" wire:model='selected_user'
                                                wire:change='filter()'>
                                                <option value="">ALL</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}"></option>
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

                        <table id="zeroConfigNew" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User Id</th>
                                    <th>Name</th>
                                    <th>Contact No</th>
                                    <th>Path</th>
                                    <th>Agency</th>
                                    <th>Account Created</th>
                                    <th>Account Status</th>
                                    {{-- <th>ACTION</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($customers))


                                    @foreach ($customers as $index => $user)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $user->id }}</td>
                                            <td></td>
                                            <td>{{ $user->mobile_no }}</td>
                                            <td>{{ $user->mobile_no }}</td>
                                            <td>
                                                @if ($user->assigned_user_side == 'A1')
                                                    Agency 1
                                                @elseif ($user->assigned_user_side == 'A2')
                                                    Agency 2
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('Y m d') }}</td>
                                            <td>
                                                @if ($user->er_status == 1)
                                                    NONE
                                                @elseif($user->er_status == 2)
                                                    HALF
                                                @elseif($user->er_status == 3)
                                                    FULL
                                                @elseif($user->er_status == 4)
                                                    ER
                                                @endif
                                            </td>

                                            {{-- <td>

                                            <a class="btn btn-danger" href="{{ route('referrals.approve', $user->id) }}"
                                                type="button">
                                                APPROVE
                                            </a>
                                            <button type="button" id="sweetalertBasic" class="btn btn-primary">
                                                Basic
                                            </button>
                                        </td> --}}

                                        </tr>
                                    @endforeach
                                @endif

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>User Id</th>
                                    <th>Name</th>
                                    <th>Contact No</th>
                                    <th>Path</th>
                                    <th>Agency</th>
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
</div>


