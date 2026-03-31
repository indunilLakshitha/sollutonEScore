<div>
    @include('livewire.comp.breadcumb', [
        'title' => 'TASKS',
        'section' => 'My work',
        'sub' => 'My Tasks',
        'action' => 'All',
    ])

    <div class="edash-content-section row g-3 g-md-4">
        <div class="col-12">
            <div class="card">
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                    <div class="card-header">
                        <h4 class="card-title mb-0">My Tasks</h4>
                        <p class="text-muted small mb-0 mt-1">Tasks assigned to you.</p>
                    </div>
                    <div class="card-header d-flex align-items-center gap-2 flex-wrap">
                        <input type="text" class="form-control" style="min-width: 220px"
                            wire:model.live.debounce.300ms="search"
                            placeholder="Search task / category..." />
                        <select class="form-select" style="min-width: 220px" wire:model.live="filter">
                            <option value="">All</option>
                            <option value="pending">Pending</option>
                            <option value="expired">Expired</option>
                            <option value="completed">Assignment complete</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                        <input type="date" class="form-control" style="width: 170px"
                            wire:model.live="filterCreatedDay" title="Created day" />
                        <input type="month" class="form-control" style="width: 160px"
                            wire:model.live="filterCreatedMonth" title="Created month" />
                        <input type="date" class="form-control" style="width: 170px"
                            wire:model.live="filterCreatedFrom" title="Created from" />
                        <input type="date" class="form-control" style="width: 170px"
                            wire:model.live="filterCreatedTo" title="Created to" />
                        <button type="button" class="btn btn-outline-secondary"
                            wire:click="clearDateFilters">
                            Clear dates
                        </button>
                    </div>
                </div>

                <div class="card-table table-responsive">
                    <table class="table mb-0 d-none d-md-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Task</th>
                                <th>Category</th>
                                <th>Deadline</th>
                                <th>Status</th>
                                <th>Score</th>
                                <th style="min-width: 340px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $index => $task)
                                <tr wire:key="my-task-{{ $task->id }}" style="cursor: pointer"
                                    wire:click="openTaskPopup({{ $task->id }})">
                                    <td>{{ ($tasks->currentPage() - 1) * $tasks->perPage() + $index + 1 }}</td>
                                    <td>{{ $task->name }}</td>
                                    <td>{{ $task->category?->name ?? '—' }}</td>
                                    <td>
                                        @if ($task->deadline_at)
                                            {{ $task->deadline_at->format('Y-m-d H:i') }}
                                        @else
                                            —
                                        @endif
                                    </td>
                                    <td>
                                        @if ($task->is_expired)
                                            <span class="badge bg-danger">Expired</span>
                                        @else
                                            <span class="badge bg-primary">{{ $task->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($task->is_expired)
                                            0
                                        @else
                                            {{ $task->score ?? '-' }}
                                        @endif
                                        / {{ $task->max_score }}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="text-muted small">Click row for quick view</span>
                                            <a class="btn btn-outline-primary btn-sm"
                                                href="{{ route('task.details', $task->id) }}"
                                                wire:click.stop>
                                                View details
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-md-none px-3 pb-3">
                    @foreach ($tasks as $index => $task)
                        <div class="card mb-3" wire:key="my-task-card-{{ $task->id }}" style="cursor: pointer"
                            wire:click="openTaskPopup({{ $task->id }})">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start gap-2">
                                    <div class="fw-semibold">
                                        {{ ($tasks->currentPage() - 1) * $tasks->perPage() + $index + 1 }}.
                                        {{ $task->name }}
                                    </div>
                                    <div class="text-end">
                                        @if ($task->is_expired)
                                            <span class="badge bg-danger">Expired</span>
                                        @else
                                            <span class="badge bg-primary">{{ $task->status }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="mt-2 small text-muted">
                                    <div><span class="fw-semibold">Category:</span> {{ $task->category?->name ?? '—' }}</div>
                                    <div>
                                        <span class="fw-semibold">Deadline:</span>
                                        @if ($task->deadline_at)
                                            {{ $task->deadline_at->format('Y-m-d H:i') }}
                                        @else
                                            —
                                        @endif
                                    </div>
                                    <div>
                                        <span class="fw-semibold">Score:</span>
                                        @if ($task->is_expired)
                                            0
                                        @else
                                            {{ $task->score ?? '-' }}
                                        @endif
                                        / {{ $task->max_score }}
                                    </div>
                                </div>

                                <hr class="my-3" />

                                <div class="d-flex align-items-center justify-content-between gap-2">
                                    <div class="text-muted small mb-0">Tap card for quick view</div>
                                    <a class="btn btn-outline-primary btn-sm"
                                        href="{{ route('task.details', $task->id) }}"
                                        wire:click.stop>
                                        View details
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div id="pg_id">{{ $tasks->links() }}</div>
            </div>
        </div>
    </div>

</div>
