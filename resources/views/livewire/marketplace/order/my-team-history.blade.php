<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="MARKETPLACE " section="Order" sub="My Team History" action="All">
        <!--! End:: Breadcumb !-->
        <div class="edash-content-section row g-3 g-md-4">

            <!-- Start:: Zero Config -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Orders</h4>
                    </div>
                    <div class="card-table table-responsive">
                        <table id="" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Order Number</th>
                                    <th>Total Amount ( Rs )</th>
                                    <th>Payment Method</th>
                                    <th>Ordered At</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order?->id }}</td>
                                        <td>{{ $order?->order_number }}</td>
                                        <td>{{ number_format($order?->total_amount, 2) }}</td>
                                        <td>
                                            @if ($order?->payment_method == 1)
                                                <span class="badge bg-warning ms-1 rounded-pill">WALLET</span>
                                            @elseif($order?->payment_method == 2)
                                                <span class="badge bg-primary ms-1 rounded-pill">COD</span>
                                            @else
                                            @endif
                                        </td>
                                        <td>{{ $order?->created_at }}</td>
                                        <td>
                                            {{ $this->getStatus($order->status) }}
                                        </td>

                                        <td>
                                            <a class="btn btn-primary"
                                                href="{{ route('order.marketHistory.view', $order->id) }}"
                                                type="button">
                                                DETAIL
                                            </a>

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Order Number</th>
                                    <th>Total Amount ( Rs )</th>
                                    <th>Payment Method</th>
                                    <th>Ordered At</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div id="pg_id">

                    {{ $orders->links() }}
                </div>
            </div>
            <!-- End:: Zero Config -->

        </div>
        <style>
            .user-list {
                max-width: 317px;
                margin: 20px auto 0 auto;
            }

            .form-group {
                text-align: center;

            }

            small {
                font-size: 12px;
                margin: 0 20px;
            }

            .card-header.is-sales-chart-title {
                width: 50%;
                text-align: center;
            }

            .er-color {
                color: green;
            }

            .full-color {
                color: rgb(23, 136, 211);
            }

            .half-color {
                color: rgb(23, 36, 211);
            }

            .point-color {
                color: red !important;
            }

            .table-responsive.col-6.border-right-sales-chart {
                border-right: 5px solid var(--expo-border-color);
            }

            .fs-12 {
                font-size: 1rem !important;
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
