<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="DEPOSITES" section="Admin" sub="Deposites" action="Deposited">
        <!--! End:: Breadcumb !-->
        <div class="edash-content-section row g-3 g-md-4">

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
                            <h4 class="card-title">Deposited Amounts</h4>
                        </div>
                        <div class="card-header">
                            {{-- <a href="{{ route('admin.customer.create') }}" class="btn btn-md btn-primary">ADD</a> --}}
                        </div>
                    </div>
                    <div class="card-table table-responsive">

                        <table id="zeroConfig" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Requested Amount</th>
                                    <th>Balance</th>
                                    <th>Requested At</th>
                                    <th>Transfered At</th>
                                    <th>Transfered By</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendings as $pending)
                                    <tr>
                                        <td>{{ $pending->id }}</td>
                                        <td>{{ $pending->user?->name }}</td>
                                        <td>{{ number_format($pending->amount, 2) }}</td>
                                        <td>{{ number_format($pending->balance, 2) }}</td>
                                        <td>{{ $pending->requested_at }}</td>
                                        <td>{{ $pending->paid_at }}</td>
                                        <td>{{ $pending->admin?->name }}</td>
                                    </tr>
                                @endforeach


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Requested Amount</th>
                                    <th>Balance</th>
                                    <th>Requested At</th>
                                    <th>Transfered At</th>
                                    <th>Transfered By</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <!-- End:: Zero Config -->
        </div>
</div>
