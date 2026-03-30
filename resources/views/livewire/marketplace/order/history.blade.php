<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="MARKETPLACE " section="Order" sub="History" action="All">
        <!--! End:: Breadcumb !-->
        <div class="edash-content-section row g-3 g-md-4">

            <!-- Start:: Zero Config -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">All Orders</h4>
                    </div>
                    <div class="card-table table-responsive">
                        <table id="zeroConfig" class="table mb-0">
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
                                        <td>{{ number_format($order?->total_amount,2) }}</td>
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
                                                href="{{ route('order.marketHistory.view', $order->id) }}" type="button">
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
            </div>
            <!-- End:: Zero Config -->

        </div>
</div>
