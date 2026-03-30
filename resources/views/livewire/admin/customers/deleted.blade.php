<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="DELETED" section="User" sub="Referrals" action="Deleted">
        <!--! End:: Breadcumb !-->
        <div class="edash-content-section row g-3 g-md-4">


            <div class="col-12">
                <div class="card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="card-header">
                            <h4 class="card-title">Referrals Deleted</h4>
                        </div>
                        <div class="card-header">
                            <button wire:click='startDeleteRequests()' class="btn btn-md btn-danger">DELETE</button>
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
                                    <th>Name</th>
                                    <th>Reg No</th>
                                    <th>Referrer</th>
                                    <th>Reg Date</th>
                                    <th>Contact No</th>
                                    <th>Deleted At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $user)
                                    <tr>

                                        <td>{{ $user->id }}</td>

                                        <td></td>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->referrer_id }}</td>
                                        <td>{{ $user->registered_at }}</td>
                                        <td>{{ $user->mobile_no }}</td>
                                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('Y m d') }}</td>




                                    </tr>
                                @endforeach


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Reg No</th>
                                    <th>Referrer</th>
                                    <th>Reg Date</th>
                                    <th>Contact No</th>
                                    <th>Deleted At</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div id="pg_id">

                        {{ $customers->links() }}
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
