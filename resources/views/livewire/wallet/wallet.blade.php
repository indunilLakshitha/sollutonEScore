<div>
    <!--! Start:: Breadcumb !-->
    <div class="edash-content-breadcumb row mb-4 mb-md-6 pt-md-2">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h2 class="h4 fw-semibold text-dark">Wallet</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">User</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">Wallet</a>
                            </li>

                        </ol>
                    </nav>
                </div>
                <div class="d-flex align-items-center gap-2">
                    @if (Auth::user()->type == 'M')
                        <button type="button" class="btn btn-md btn-primary d-block request" data-bs-toggle="modal"
                            data-bs-target="#exampleModal" id="btn_withdraw">
                            <span class="ms-2 ">WITHDRAW</span>
                        </button>
                    @endif
                </div>


                <button type="button" class="btn btn-md btn-primary d-block request d-none" data-bs-toggle="modal"
                    data-bs-target="#exampleModal2" id="btn_otp">
                    <span class="ms-2 ">WITHDRAW</span>
                </button>


            </div>
        </div>
    </div>
    <!--! End:: Breadcumb !-->
    <div class="edash-content-section row g-3 g-md-4">
        <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                            Withdraw Money
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input class="form-control mb-2" id="request_amount_id" type="number"
                            value="{{ $minimum }}" wire:model='amount_requesting' />
                        @error('amount_requesting')
                            <div style="color: red">
                                {{ $message }}
                            </div>
                        @enderror
                        @if (!isset($bank_details))
                            <p class="color-warning">You didn't enter any bank details. Please add your bank details.
                            </p>
                        @endif
                        Withdrawal requests are processed within 1-3 business days after verification. Ensure
                        your
                        bank details are correct to avoid delays.
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="close_modal_btn" class="btn btn-danger" data-bs-dismiss="modal">
                            Close
                        </button>
                        @if (isset($bank_details))
                            <button type="button" class="btn btn-primary" wire:click="sendOtp()">
                                Withdraw to Bank
                            </button>
                        @endif

                        {{-- <button type="button" class="btn btn-primary" wire:click="request()">
                            Withdraw to Bank
                        </button> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal2" aria-labelledby="exampleModal2Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabe2">
                            Verify OTP
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input class="form-control mb-2" id="request_amount_id" type="number"
                            wire:model='otp_number' />

                    </div>
                    <div class="modal-footer">
                        <button type="button" id="close_modal_btn_otp" class="btn btn-danger" data-bs-dismiss="modal">
                            Close
                        </button>

                        <button type="button" class="btn btn-primary" wire:click="verifyOtp()">
                            Verify OTP
                        </button>

                    </div>
                </div>
            </div>
        </div>
        <!-- Start:: Filter -->
        <div class="col-12">
            <div class="row">
                <div class="col-9">
                </div>
                <div class="col-3">

                </div>
            </div>

        </div>
        <div class="">
            <div class="card-body">
                <div class="row g-3 g-md-4">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between pd-5">
                                    <div class="avatar avatar-xl rounded bg-warning-subtle text-warning">
                                        <i class="fi fi-rr-shopping-cart-add"></i>
                                    </div>
                                    <div class="text-end">
                                        <h4 class="fs-18 fw-semibold">
                                            {{ env('CURRENCY') }}{{ number_format($wallet?->balance, 2) }}</h4>
                                        <span class="fs-13 text-muted">BALANCE</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between pd-5">
                                    <div class="avatar avatar-xl rounded bg-danger-subtle text-danger">
                                        <i class="fi fi-rr-cart-minus"></i>
                                    </div>
                                    <div class="text-end">
                                        <h4 class="fs-18 fw-semibold">
                                            {{ env('CURRENCY') }}{{ number_format($requested_amount, 2) }}
                                        </h4>
                                        <span class="fs-13 text-muted">REQUESTED</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between pd-5">
                                    <div class="avatar avatar-xl rounded bg-success-subtle text-success">
                                        <i class="fi fi-rr-sack-dollar"></i>
                                    </div>
                                    <div class="text-end">
                                        <h4 class="fs-18 fw-semibold">
                                            {{ env('CURRENCY') }}{{ number_format($total_amount, 2) }}</h4>
                                        <span class="fs-13 text-muted">TOTAL TRANSFERED</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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

        <div class="col-12">
            <div class="card">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="card-header col-4">
                        <h4 class="card-title">All Transactions</h4>
                    </div>
                    <div class="card-header">
                        <label class="form-label">Date From:</label>

                    </div>
                    <div class="card-header">

                        <input type="date" class="form-control" wire:model='date_from'
                            wire:change='filter()'></input>
                    </div>
                    <div class="card-header">
                        <label class="form-label">Date To:</label>
                    </div>
                    <div class="card-header">
                        <input type="date" class="form-control" wire:model='date_to'
                            wire:change='filter()'></input>
                    </div>

                </div>
                <div class="card-table table-responsive">
                    <table id="zeroConfig" class="table mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Amount ( Rs )</th>
                                <th>Date</th>
                                <th>Requested At</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($walletHistory as $history)
                                <tr>
                                    <td>{{ $history->id }}</td>

                                    <td>{{ number_format($history->amount, 2) }}</td>
                                    <td>{{ $history->created_at }}</td>
                                    <td>{{ $history->requested_at }}</td>
                                    <td>
                                        @if ($history->status == 1 && $history->type != 1)
                                            <span class="badge bg-primary ms-1 rounded-pill">REQUESTED</span>
                                        @elseif ($history->status == 2 && $history->type != 1)
                                            @if ($history->comission_type == 4)
                                                <span class="badge bg-success ms-1 rounded-pill">MARKETPLACE
                                                    PURCHASE</span>
                                            @else
                                                <span class="badge bg-success ms-1 rounded-pill">TRANSFERED</span>
                                            @endif
                                        @elseif ($history->status == 3 && $history->type != 1)
                                            <span class="badge bg-danger ms-1 rounded-pill">CANCELED</span>
                                        @else
                                        @endif
                                        @if ($history->reason)
                                            @if ($history->type == 1)
                                                <span class="badge bg-success ms-1 rounded-pill">TRANSFERED</span>
                                            @endif
                                            @if ($history->type == 1)
                                                <span class="badge bg-warning ms-1 ">ADDED BY ADMIN</span>
                                            @endif
                                            @if ($history->type == 2)
                                                <span class="badge bg-danger ms-1 ">REMOVED BY ADMIN</span>
                                            @endif
                                            <span class="badge bg-primary ms-1 ">{{ $history->reason }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($history->status == 1 && $history->type != 1)
                                            <button type="button" wire:click='cansel({{ $history->id }})'
                                                wire:confirm="Are you sure you want to Cancel this?"
                                                class="btn btn-md btn-danger">
                                                Cancel
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Amount ( Rs )</th>
                                <th>Date</th>
                                <th>Requested At</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- End:: Zero Config -->
    </div>

    <style>
        .request {
            margin-left: auto;
            margin-bottom: 30px;
        }

        .color-warning {
            color: red
        }
    </style>
</div>

<script>
    window.addEventListener('close_modal', function(e) {
        document.getElementById("close_modal_btn").click();
    });
    window.addEventListener('close_modal_otp', function(e) {
        document.getElementById("close_modal_btn_otp").click();
    });

    window.addEventListener('update_modal', function(e) {
        document.getElementById("btn_otp").click();
    });
</script>
