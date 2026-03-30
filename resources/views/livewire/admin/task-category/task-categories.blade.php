<div>
    <livewire:comp.breadcumb title="TASKS" section="Admin" sub="Task Categories" action="All">
        <div class="edash-content-section row g-3 g-md-4">
            <div class="col-12">
                <div class="card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="card-header">
                            <h4 class="card-title">Task Categories</h4>
                        </div>
                        <div class="card-header d-flex align-items-center gap-3">
                            <div class="input-group" style="min-width: 260px">
                                <span class="input-group-text"><i class="fi fi-rr-search"></i></span>
                                <input type="text" class="form-control" wire:model.live="search"
                                    placeholder="Search category..." />
                            </div>
                            <a href="{{ route('admin.task-category.create') }}" class="btn btn-md btn-primary">ADD</a>
                        </div>
                    </div>

                    <div class="card-table table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Active</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $index => $cat)
                                    <tr>
                                        <td>{{ ($categories->currentPage() - 1) * $categories->perPage() + $index + 1 }}
                                        </td>
                                        <td>{{ $cat->name }}</td>
                                        <td>
                                            @if ($cat->is_active)
                                                <span class="badge bg-success">ACTIVE</span>
                                            @else
                                                <span class="badge bg-danger">INACTIVE</span>
                                            @endif
                                        </td>
                                        <td class="d-flex gap-2">
                                            <a class="btn btn-primary"
                                                href="{{ route('admin.task-category.edit', $cat->id) }}">EDIT</a>
                                            @if ($cat->is_active)
                                                <button class="btn btn-warning"
                                                    wire:click='toggleActive({{ $cat->id }})'
                                                    type="button">DISABLE</button>
                                            @else
                                                <button class="btn btn-warning"
                                                    wire:click='toggleActive({{ $cat->id }})'
                                                    type="button">ENABLE</button>
                                            @endif
                                            <button class="btn btn-danger" wire:click='delete({{ $cat->id }})'
                                                wire:confirm="Are you sure you want to delete this category?"
                                                type="button">DELETE</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="pg_id">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
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
