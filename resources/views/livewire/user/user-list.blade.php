<div>
    <!--! Start:: Breadcumb !-->
    <div class="edash-content-breadcumb row mb-4 mb-md-6 pt-md-2">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h2 class="h4 fw-semibold text-dark">dataTable</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">Components</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">Tables</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                dataTable
                            </li>
                        </ol>
                    </nav>
                </div>
                @if (Auth::user()->is_admin)
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('user.create') }}" class="btn btn-md btn-primary">
                            ADD</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!--! End:: Breadcumb !-->
    <div class="edash-content-section row g-3 g-md-4">

        <!-- Start:: Zero Config -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Users</h4>
                </div>
                <div class="card-table table-responsive">
                    <table id="zeroConfig" class="table mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Unique Id</th>
                                <th>Type</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td></td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->er_status }}</td>
                                    <td>{{ $user->unique_id }}</td>
                                    <td>{{ $user->type }}</td>
                                    <td> <button class="btn btn-primary" wire:click='edit({{ $user->id }})'
                                            type="button">
                                            EDIT
                                        </button></td>

                                </tr>
                            @endforeach


                        </tbody>
                        <tfoot>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Unique Id</th>
                                <th>Type</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- End:: Zero Config -->
    </div>
</div>
