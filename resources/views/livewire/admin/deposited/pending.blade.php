<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="Withdrawal Requests" section="Admin" sub="Withdrawal" action="Requests">
        <!--! End:: Breadcumb !-->

        <div class="edash-content-section row g-3 g-md-4">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <!--  -->
                        <form action="#" class="form-group" id="repeaterAdvanced">
                            <div data-repeater-list="repeater-advanced">
                                <div data-repeater-item>
                                    <div class="form-group row mb-4">
                                        <div class="col-lg-2 mb-2 mb-md-0">
                                            <label class="form-label">Status:</label>
                                            <select class="form-select" wire:model='status' wire:change='filter()'>
                                                <option value="0" class="d-none"> Select Status</option>
                                                <option value="1"> REQUESTED</option>
                                                <option value="2"> TRANSFERED</option>
                                                <option value="3"> CANSELED</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-2 mb-2 mb-md-0">
                                            <label class="form-label">From:</label>
                                            <input class="form-control" type="date" wire:model='from'
                                                wire:change='filter()'>
                                        </div>
                                        <div class="col-lg-2 mb-2 mb-md-0">
                                            <label class="form-label">To:</label>
                                            <input class="form-control" type="date" wire:model='to'
                                                wire:change='filter()'>
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
            <div class="row  g-md-4">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-center justify-content-between pd-5">
                                <div class="avatar avatar-xl rounded bg-warning-subtle text-warning">
                                    <i class="fi fi-rr-chart-histogram"></i>
                                </div>
                                <div class="text-end">
                                    <h4 class="fs-18 fw-semibold">
                                        {{ env('CURRENCY') }}{{ number_format($total_withdrawal_requests, 2) }}</h4>
                                    <span class="fs-13 text-muted">Total Withdrawal Requests</span>
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
                                    <i class="fi fi-rr-stats"></i>
                                </div>
                                <div class="text-end">
                                    <h4 class="fs-18 fw-semibold">
                                        {{ env('CURRENCY') }}{{ number_format($total_pending_deposites, 2) }} </h4>
                                    <span class="fs-13 text-muted">Total Pending Deposits</span>
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
                                        {{ env('CURRENCY') }}{{ number_format($total_deposites, 2) }}</h4>
                                    <span class="fs-13 text-muted"> Total Deposits</span>
                                </div>
                            </div>
                        </div>
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
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div class="card-header">
                            <h4 class="card-title">Requested Amounts</h4>
                        </div>
                        <div class="pe-3 pb-3 pb-md-0 d-flex gap-2">
                            <button class="btn btn-outline-success d-flex align-items-center gap-2"
                                wire:click="exportExcel" wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="exportExcel"><i class="fi fi-rr-file-excel"></i>
                                    Export Excel</span>
                                <span wire:loading wire:target="exportExcel">
                                    <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                    Exporting...
                                </span>
                            </button>
                            <button class="btn btn-outline-primary d-flex align-items-center gap-2"
                                wire:click="exportPdf" wire:loading.attr="disabled">
                                <span wire:loading.remove wire:target="exportPdf"><i class="fi fi-rr-download"></i>
                                    Export PDF</span>
                                <span wire:loading wire:target="exportPdf">
                                    <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                    Exporting...
                                </span>
                            </button>
                        </div>
                    </div>
                    <div class="card-table table-responsive">

                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Mobile No</th>
                                    <th>Requested Amount</th>
                                    <th>Balance ( Rs )</th>
                                    <th>Requested At</th>
                                    <th>Bank Details</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendings as $pending)
                                    <tr>
                                        <td>{{ $pending->id }}</td>
                                        <td>{{ $pending->user?->name }}</td>
                                        <td>{{ $pending->user?->mobile_no }}</td>
                                        <td>{{ number_format($pending->amount, 2) }}</td>
                                        <td>{{ number_format($pending->wallet?->balance, 2) }}</td>
                                        <td>{{ $pending->requested_at }}</td>
                                        <td>
                                            <dl class="dl-horizontal mb-0 remove-margin ">
                                                <dt class="remove-margin">Account Holder :</dt>
                                                <dd class="remove-margin">{{ $pending->user?->bank?->holder_name }}
                                                    @if (isset($pending->user?->bank?->holder_name))
                                                        <button class=" btn p-0"
                                                            wire:click='copyBankDetails( {{ $pending->user?->bank }},1 )'>
                                                            <i class="fi fi-rr-layers"></i>

                                                        </button>
                                                    @endif
                                                </dd>
                                                <dt class="remove-margin">Acc No:</dt>
                                                <dd class="remove-margin">{{ $pending->user?->bank?->account_number }}
                                                    @if (isset($pending->user?->bank?->holder_name))
                                                        <button class=" btn p-0"
                                                            wire:click='copyBankDetails({{ $pending->user?->bank }},2)'>
                                                            <i class="fi fi-rr-layers"></i>

                                                        </button>
                                                    @endif
                                                </dd>
                                                <dt class="remove-margin">Bank:</dt>
                                                <dd class="remove-margin">{{ $pending->user?->bank?->bank_name }}
                                                    @if (isset($pending->user?->bank?->holder_name))
                                                        <button class=" btn p-0"
                                                            wire:click='copyBankDetails({{ $pending->user?->bank }},3)'>
                                                            <i class="fi fi-rr-layers"></i>

                                                        </button>
                                                    @endif
                                                </dd>
                                                <dt class="remove-margin">Branch:</dt>
                                                <dd class="remove-margin">{{ $pending->user?->bank?->branch }}
                                                    @if (isset($pending->user?->bank?->holder_name))
                                                        <button class=" btn p-0"
                                                            wire:click='copyBankDetails({{ $pending->user?->bank }},4)'>
                                                            <i class="fi fi-rr-layers"></i>

                                                        </button>
                                                    @endif
                                                </dd>


                                            </dl>
                                        </td>

                                        <td>

                                            {{-- <button class="btn btn-danger" wire:click='approve({{ $user->id }})'
                                                wire:confirm="Are you sure you want to Approve this customer?"
                                                type="button">
                                                APPROVE
                                            </button> --}}

                                            @if ($pending->status == 1)
                                                <button class="btn btn-primary"
                                                    wire:click='approve({{ $pending->id }})'
                                                    wire:confirm="Are you sure you want to Pay this?" type="button">
                                                    APPROVE
                                                </button>

                                            <button class="btn btn-danger" wire:click='cansel({{ $pending->id }})'
                                                wire:confirm="Are you sure you want to Cancel this Request?"
                                                type="button">
                                                CANCEL
                                            </button>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Mobile No</th>
                                    <th>Requested Amount</th>
                                    <th>Balance (LKR)</th>
                                    <th>Requested At</th>
                                    <th>Bank Details</th>
                                    <th>ACTION</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div id="pg_id">

                        {{ $pendings->links() }}
                    </div>
                </div>
            </div>
            <!-- End:: Zero Config -->
        </div>

        <style>
            .remove-margin {
                margin-bottom: 0 !important;
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
    window.addEventListener('bank_set', function(e) {
        copy(e);
    });

    function copy(data) {

        var text = data.detail[0].text;
        navigator.clipboard.writeText(text);

        Swal.mixin({
            toast: !0,
            position: "top-end",
            showConfirmButton: !1,
            timer: 3e3,
            timerProgressBar: !0,
            didOpen: function didOpen(t) {
                t.addEventListener("mouseenter", Swal.stopTimer), t.addEventListener("mouseleave",
                    Swal.resumeTimer);
            }
        }).fire({
            icon: "success",
            title: text
        });
    }
</script>
