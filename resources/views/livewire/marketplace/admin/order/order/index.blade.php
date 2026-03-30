<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="ORDERS" section="Admin" sub="Order" action="List">
        <!--! End:: Breadcumb !-->
        <div class="edash-content-section row g-3 g-md-4">
            <!-- Start:: Filter -->

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
                            <h4 class="card-title">Orders</h4>
                        </div>
                        <div class="card-header">
                            {{-- <a href="#" --}}
                            {{-- class="btn btn-md btn-primary">ADD</a> --}}
                        </div>
                    </div>
                    <div class="card-table table-responsive">
                        <table id="" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Order Number</th>
                                    <th>Name</th>
                                    <th>Contact No</th>
                                    <th>Amount</th>
                                    <th>Status</th>

                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $index => $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ $order->first_name . ' ' . $order->last_name }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>{{ number_format($order->total_amount, 2) }}</td>
                                        <td>
                                            {{ $this->getStatus($order->status) }}
                                        </td>


                                        <td>
                                            <a class="btn btn-primary"
                                                href="{{ route('marketplace.admin.order.view', $order->id) }}"
                                                type="button">
                                                VIEW
                                            </a>
                                            {{-- <button class="btn btn-danger" wire:click='delete({{ $product->id }})'
                                                wire:confirm="Are you sure you want to Delete this Category?"
                                                type="button">
                                                DELETE
                                            </button> --}}
                                        </td>

                                    </tr>
                                @endforeach


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Order Number</th>
                                    <th>Name</th>
                                    <th>Contact No</th>
                                    <th>Amount</th>
                                    <th>Status</th>

                                    <th>ACTION</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div id="pg_id">

                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
            <!-- End:: Zero Config -->
        </div>
        <style>
            .main-color {
                color: green
            }

            .dummy-color {
                color: orange
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
