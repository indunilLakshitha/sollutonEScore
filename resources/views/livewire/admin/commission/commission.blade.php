<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="COMMISION" section="Admin" sub="Comission" action="All">
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
                                            <label class="form-label">Payment Status:</label>
                                            <select class="form-select" wire:model='selected_payment_status'
                                                wire:change='filter()'>
                                                <option value="0">ALL</option>
                                                <option value="1">PENDING</option>
                                                <option value="2">PAID</option>

                                            </select>
                                        </div> --}}

                                        <div class="col-lg-2 mb-2 mb-md-0">
                                            <label class="form-label">Account Type:</label>
                                            <select class="form-select" wire:model='selected_account_type'
                                                wire:change='filter()'>
                                                <option value="">ALL</option>
                                                <option value="1">Main</option>
                                                <option value="2">Dummy</option>

                                            </select>
                                        </div>
                                        <div class="col-lg-2 mb-2 mb-md-0">
                                            <label class="form-label">Comission Type:</label>
                                            <select class="form-select" wire:model='selected_comission_type'
                                                wire:change='filter()'>
                                                <option value="">ALL</option>
                                                <option value="2">DSC</option>
                                                <option value="1">GSC</option>

                                            </select>
                                        </div>
                                        {{-- <div class="col-lg-2 mb-2 mb-md-0">
                                            <label class="form-label">Commision Type:</label>
                                            <select class="form-select" wire:model='selected_comission_type'
                                                wire:change='filter()'>
                                                <option value="0">ALL</option>
                                                <option value="1">PENDING</option>
                                                <option value="2">PAID</option>

                                            </select>
                                        </div> --}}

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
                            <h4 class="card-title">Commisions</h4>
                        </div>
                        <div class="input-group ms-auto w-25 me-3">
                            <span class="input-group-text"><i class="fi fi-rr-search"></i></span>
                            <input type="text" class="form-control" wire:model='search'
                                wire:input='filter' wire:change='filter()' placeholder="Search here...">
                        </div>
                        <div class="card-header">
                            <a href="{{ route('admin.commission.generate') }}"
                                class="btn btn-md btn-primary">GENERATE</a>
                        </div>
                    </div>
                    <div class="card-table table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Type</th>
                                    <th>Customer No</th>
                                    <th>Account Type</th>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th>Date</th>

                                    {{-- <th>Payment</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comissions as $index => $comission)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if ($comission->comission_type == 1)
                                                GSC
                                            @elseif ($comission->comission_type == 2)
                                                DSC
                                            @endif
                                        </td>
                                        <td>{{ $comission->user?->reg_no }}</td>
                                        <td>
                                            @if ($comission->user_type == 'M')
                                                <h6 class="main-color">MAIN</h6>
                                            @elseif ($comission->user_type == 'A1')
                                                <h6 class="dummy-color">DUMMY</h6>
                                            @elseif ($comission->user_type == 'A2')
                                                <h6 class="dummy-color">DUMMY</h6>
                                            @endif
                                        </td>
                                        <td>{{ $comission->user?->first_name . ' ' . $comission->user?->last_name }}
                                        </td>
                                        <td>{{ number_format($comission->amount, 2) }}</td>
                                        <td>{{ $comission->created_at }}</td>



                                    </tr>
                                @endforeach


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Type</th>
                                    <th>Customer No</th>
                                    <th>Account Type</th>

                                    <th>Amount</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    {{-- <th>Payment</th> --}}
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div id="pg_id">

                        {{ $comissions->links() }}
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
        </style>
</div>
