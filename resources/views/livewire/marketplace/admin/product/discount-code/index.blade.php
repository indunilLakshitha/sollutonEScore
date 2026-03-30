<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="DISCOUNT CODE" section="Admin" sub="Product" action="Discount Codes">
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
                            <h4 class="card-title">Discount Codes</h4>
                        </div>
                        <div class="card-header">

                            <a href="{{ route('marketplace.admin.discountCode.create') }}"
                                class="btn btn-md btn-primary">ADD </a>
                        </div>
                    </div>
                    <div class="card-table table-responsive">
                        <table id="" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Code</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Expiried At</th>

                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($codes as $code)
                                    <tr>
                                        <td>{{ $code->id }}</td>
                                        <td>{{ $code->name }}</td>
                                        <td>{{ $code->code }}</td>
                                        <td>{{ $code->type }}</td>
                                        <td>{{ $code->percent_amount }}</td>
                                        <td>{{ $code->expire_date }}</td>



                                        <td>

                                            <a class="btn btn-primary"
                                                href="{{ route('marketplace.admin.discountCode.edit', $code->id) }}"
                                                type="button">
                                                EDIT
                                            </a>
                                            <button class="btn btn-danger" wire:click='delete({{ $code->id }})'
                                                wire:confirm="Are you sure you want to Delete this Code?"
                                                type="button">
                                                DELETE
                                            </button>
                                        </td>

                                    </tr>
                                @endforeach


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Code</th>

                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Expiried At</th>

                                    <th>ACTION</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div id="pg_id">

                        {{ $codes->links() }}
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
