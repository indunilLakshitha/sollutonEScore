<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="INCOME REPORT" section="User" sub="Income" action="All">
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
                                            <label class="form-label">Date From:</label>
                                            <input type="date" class="form-control" wire:model='date_from'
                                                wire:change='filter()'></input>
                                        </div>
                                        <div class="col-lg-2 mb-2 mb-md-0">
                                            <label class="form-label">Date To:</label>
                                            <input type="date" class="form-control" wire:model='date_to'
                                                wire:change='filter()'></input>
                                        </div>
                                        {{-- <div class="col-lg-2 mb-2 mb-md-0">
                                            <label class="form-label">Payment Type:</label>
                                            <select class="form-select" wire:model='selected_payment_status'>
                                                <option>--select--</option>
                                                <option value="1">Unpaid</option>
                                                <option value="2">Paid</option>

                                            </select>
                                        </div> --}}

                                        <div class="col-lg-2 mb-2 mb-md-0">
                                            <label class="form-label">Commision Type:</label>
                                            <select class="form-select" wire:model='selected_comission_type'
                                                wire:change='filter()'>
                                                <option value="0">ALL</option>
                                                <option value="1">GSC </option>
                                                <option value="2">DSC </option>
                                                <option value="3">DUMMY TRANSFERED </option>

                                            </select>
                                        </div>
                                        <div class="col-lg-2 mb-2 mb-md-0">
                                            <label class="form-label">Account Type:</label>
                                            <select class="form-select" wire:model='selected_account_type'
                                                wire:change='filter()'>
                                                <option value="">ALL</option>
                                                <option value="1">Main</option>
                                                <option value="2">Dummy</option>

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
                            <h4 class="card-title">Income Report</h4>
                        </div>

                    </div>
                    <div class="card-table table-responsive">
                        <table id="zeroConfig" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Account No</th>
                                    <th>Comission Type</th>
                                    <th>Account Type</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comissions as $index => $comission)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $comission->user_id }}</td>
                                        <td>
                                            @if ($comission->comission_type == 1)
                                                GSC
                                            @elseif ($comission->comission_type == 2)
                                                DSC
                                            @elseif ($comission->comission_type == 3)
                                                DUMMY TRANSFERD
                                            @endif
                                        </td>
                                        <td>
                                            @if ($comission->user_type == 'M')
                                                <h6 class="main-color">MAIN</h6>
                                            @elseif ($comission->user_type == 'A1')
                                                <h6 class="dummy-color">DUMMY</h6>
                                            @elseif ($comission->user_type == 'A2')
                                                <h6 class="dummy-color">DUMMY</h6>
                                            @endif
                                        </td>
                                        <td>{{env('CURRENCY')}}{{ number_format($comission->amount, 2) }}</td>
                                        <td>{{ $comission->created_at }}</td>
                                    </tr>
                                @endforeach


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Account No</th>
                                    <th>Comission Type</th>
                                    <th>Account Type</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End:: Zero Config -->
        </div>
</div>
