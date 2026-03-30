<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="Criteria" section="Admin" sub="Criteria" action="List">
        <!--! End:: Breadcumb !-->
        <div class="edash-content-section row g-3 g-md-4">
            <!-- Start:: Zero Config -->
            <div class="col-12">
                <div class="card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="card-header">
                            <h4 class="card-title">Criteria List</h4>
                        </div>
                        <div class="input-group ms-auto w-25 me-3">
                            <span class="input-group-text"><i class="fi fi-rr-search"></i></span>
                            <input type="text" class="form-control" wire:model='search'
                                wire:input='filter' wire:change='filter()' placeholder="Search here...">
                        </div>
                        <div class="card-header">
                            <a href="{{ route('admin.criteria.create') }}" class="btn btn-md btn-primary">ADD</a>
                        </div>
                    </div>
                    <div class="card-table table-responsive">
                        <table id="" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Count</th>
                                    <th>Status</th>
                                    <th>Added By</th>
                                    <th>Created At</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($criterias as $index => $criteria)
                                    <tr>
                                        <td>{{ $index + 1 + $criterias->perPage() * ($criterias->currentPage() - 1) }}</td>
                                        <td>{{ $criteria->name }}</td>
                                        <td>{{ $criteria->description ?? 'N/A' }}</td>
                                        <td>{{ $criteria->count }}</td>
                                        <td>
                                            @if($criteria->status)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ $criteria->addedBy->name ?? 'N/A' }}</td>
                                        <td>{{ $criteria->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('admin.criteria.edit', $criteria->id) }}"
                                                type="button">
                                                EDIT
                                            </a>
                                            <button class="btn btn-danger btn-sm" wire:click='delete({{ $criteria->id }})'
                                                wire:confirm="Are you sure you want to Delete this Criteria?"
                                                type="button">
                                                DELETE
                                            </button>
                                            <a class="btn btn-info btn-sm"
                                               href="{{ route('admin.criteria.assign-users', $criteria->id) }}"
                                               type="button">
                                                ASSIGN USERS
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center">
                        {{ $criterias->links() }}
                    </div>
                </div>
            </div>
            <!-- End:: Zero Config -->
        </div>
</div>
