<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="ADMIN" section="Admin" sub="Users" action="All">
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
                            <h4 class="card-title">Admin Users</h4>
                        </div>
                        <div class="card-header">
                            <a href="{{ route('admin.user.create') }}" class="btn btn-md btn-primary">ADD</a>
                        </div>
                    </div>
                    <div class="card-table table-responsive">
                        <table id="zeroConfig" class="table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Id</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Permissions</th>
                                    <th scope="col">Created</th>

                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($adminUsers as $index => $user)
                                    <tr>
                                        <td>{{ ($adminUsers->currentPage() - 1) * $adminUsers->perPage() + $index + 1 }}</td>
                                        <td>{{ $user->id }}</td>
                                        <td></td>
                                        <td></td>
                                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('Y m d') }}</td>

                                        <td>
                                            <a class="btn btn-primary" href="{{ route('admin.user.edit', $user->id) }}"
                                                type="button">
                                                CHANGE PASSWORD
                                            </a>

                                            <button class="btn btn-danger" wire:click='delete({{ $user->id }})'
                                                wire:confirm="Are you sure you want to Delete this Course?"
                                                type="button">
                                                DELETE
                                            </button>
                                        </td>

                                    </tr>
                                @endforeach


                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Id</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Permissions</th>
                                    <th scope="col">Created</th>

                                    <th scope="col">ACTION</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div id="pg_id">
                        {{ $adminUsers->links() }}
                    </div>
                </div>
            </div>
            <!-- End:: Zero Config -->
        </div>
</div>
