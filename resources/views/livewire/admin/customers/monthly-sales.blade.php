<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="Report" section="Admin" sub="Sales" action="Performance Report">
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
                                                wire:input='showFilterButton()'></input>
                                        </div>
                                        <div class="col-lg-2 mb-2 mb-md-0">
                                            <label class="form-label">Date To:</label>
                                            <input type="date" class="form-control" wire:model='date_to'
                                                wire:input='showFilterButton()'></input>
                                        </div>

                                        <div class="col-lg-2 mb-2 mb-md-0">
                                            <label class="form-label">Month:</label>
                                            <select class="form-select" wire:model='selected_month'
                                                wire:change="filter()">
                                                <option>select month</option>
                                                @foreach ($months as $month)
                                                    <option value="{{ $month }}">{{ $month }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="col-lg-2 mb-2 mb-md-0">
                                            <label class="form-label">Rank:</label>
                                            <select class="form-select" wire:model='promotion_selected'
                                                wire:change="filter()">
                                                <option>select rank</option>
                                                @foreach ($promotionList as $rank)
                                                    <option value="{{ $rank->id }}">{{ $rank->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        @if ($filterEnabled)
                                            <div class="col-lg-2 mb-2 mb-md-0 pt-1">
                                                <button class="btn btn-md btn-soft-primary d-block mt-4" type="button"
                                                    wire:click="clear()">

                                                    <span class="ms-2">CLEAR</span>
                                                </button>
                                            </div>
                                        @endif


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
                            <h4 class="card-title">Performance Report</h4>
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
                                    <th>ID</th>
                                    <th>Customer Name</th>
                                    <th wire:click="sortBy('approved_referrals_count')" style="cursor: pointer;">Sales
                                        Count ({{ env('CURRENCY') }}) {!! $sortDirection === 'asc' ? '↑' : '↓' !!}</th>
                                    <th wire:click="sortBy('total_earnings')" style="cursor: pointer;">
                                        Total Earnings ({{ env('CURRENCY') }}) {!! $sortDirection === 'asc' ? '↑' : '↓' !!}
                                    </th>
                                    <th>Promotions </th>
                                    <th>Previous Month 1 ( {{ env('CURRENCY') }})</th>
                                    <th>Previous Month 2 ( {{ env('CURRENCY') }})</th>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales as $index => $sale)
                                    <tr>
                                        <td>{{ $index + 1 + $sales->perPage() * ($sales->currentPage() - 1) }}</td>
                                        <td>{{ $sale?->user?->reg_no }}</td>
                                        <td>{{ $sale?->user?->first_name . ' ' . $sale?->user?->last_name }}</td>
                                        <td>{{ $sale?->user?->approved_referrals_count }}</td>
                                        <td>{{ number_format($sale->total_earnings, 2) }}</td>
                                        <td>
                                            @isset($sale?->promotions)
                                                @foreach ($sale?->promotions as $promotion)
                                                    <div class="badge bg-primary">{{ $promotion?->promotion?->name }}</div>
                                                @endforeach
                                            @endisset
                                        </td>
                                        <td>{{ number_format($sale->previousFirstMonthValue, 2) }} ( {{ $sale->previuosFirstMonthSales }} )</td>
                                        <td>{{ number_format($sale->previousSecondMonthValue, 2) }}  ( {{ $sale->previuosSecondMonthSales }} )</td>
                                    </tr>
                                @endforeach


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Customer Name</th>
                                    <th>Sales Count</th>
                                    <th>Total Earnings ({{ env('CURRENCY') }})</th>
                                    <th>Promotions ({{ env('CURRENCY') }})</th>
                                    <th>Previous Month 1 ( {{ env('CURRENCY') }})</th>
                                    <th>Previous Month 2 ( {{ env('CURRENCY') }})</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div id="pg_id">

                        {{ $sales->links() }}
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
