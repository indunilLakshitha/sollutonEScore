<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="ORDER DETAIL" section="Admin" sub="Order" action="Details">
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
                            <h4 class="card-title">Order</h4>
                        </div>
                        <div class="card-header">

                        </div>
                    </div>
                    <div class="card-table table-responsive">
                        <table id="" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Order Number</th>
                                    <th>Name</th>
                                    <th></th>
                                    <th>Amount</th>
                                    <th>Status</th>


                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->first_name . ' ' . $order->last_name }}</td>
                                    <td>
                                        <dl class="dl-horizontal mb-0 remove-margin ">
                                            <dt class="remove-margin">Address 1 :</dt>
                                            <dd class="remove-margin">{{ $order->address_one }}</dd>
                                            <dt class="remove-margin">Postal :</dt>
                                            <dd class="remove-margin">{{ $order->postal_code }}</dd>
                                            <dt class="remove-margin">Contact Number :</dt>
                                            <dd class="remove-margin">{{ $order->phone }}</dd>
                                        </dl>
                                    </td>
                                    <td>{{ number_format($order->total_amount, 2) }}</td>
                                    <td>
                                        {{ $this->getStatus($order->status) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="card-header">
                            <h4 class="card-title">Items</h4>
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

                                    <th>Product Id</th>
                                    <th>Name</th>
                                    <th>SKU</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>

                                        <td>{{ $item?->product?->id }}</td>
                                        <td>{{ $item?->product?->title }}</td>
                                        <td>{{ $item?->product?->sku }}</td>
                                        <td>{{ number_format($item?->product?->price) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
