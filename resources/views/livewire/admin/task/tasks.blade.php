<div>
    <livewire:comp.breadcumb title="TASKS" section="Admin" sub="Task Management" action="All">
        <div class="edash-content-section row g-3 g-md-4">
            <div class="col-12">
                <div class="card">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div class="card-header">
                            <h4 class="card-title">Tasks</h4>
                        </div>
                        <div class="card-header d-flex align-items-center flex-wrap gap-2 justify-content-end">
                            <div class="btn-group flex-wrap" role="group" aria-label="Task Sections">
                                <button type="button"
                                    class="btn btn-sm btn-outline-dark {{ $section === 'all' ? 'active' : '' }}"
                                    wire:click="$set('section','all')">All</button>
                                <button type="button"
                                    class="btn btn-sm btn-outline-warning {{ $section === 'pending_assignment' ? 'active' : '' }}"
                                    wire:click="$set('section','pending_assignment')">Pending assignment</button>
                                <button type="button"
                                    class="btn btn-sm btn-outline-info {{ $section === 'assigned' ? 'active' : '' }}"
                                    wire:click="$set('section','assigned')">Assigned</button>
                                <button type="button"
                                    class="btn btn-sm btn-outline-primary {{ $section === 'assignment_complete' ? 'active' : '' }}"
                                    wire:click="$set('section','assignment_complete')">Assignment Completed</button>
                                <button type="button"
                                    class="btn btn-sm btn-outline-success {{ $section === 'approve' ? 'active' : '' }}"
                                    wire:click="$set('section','approve')">Approved</button>
                                <button type="button"
                                    class="btn btn-sm btn-outline-danger {{ $section === 'reject' ? 'active' : '' }}"
                                    wire:click="$set('section','reject')">Rejected</button>
                                <button type="button"
                                    class="btn btn-sm btn-outline-secondary {{ $section === 'completed' ? 'active' : '' }}"
                                    wire:click="$set('section','completed')">Completed</button>
                            </div>
                            <div class="input-group" style="min-width: 260px">
                                <span class="input-group-text"><i class="fi fi-rr-search"></i></span>
                                <input type="text" class="form-control" wire:model.live="search"
                                    placeholder="Search task / member / category..." />
                            </div>
                            <a href="{{ route('admin.task.create') }}" class="btn btn-md btn-primary">ADD</a>
                        </div>
                    </div>

                    <div class="card-body border-top border-bottom py-3">
                        <div class="row g-2 align-items-end flex-wrap">
                            <div class="col-12 col-sm-6 col-md-auto">
                                <label class="form-label small text-muted mb-1">Single date</label>
                                <input type="date" class="form-control form-control-sm" wire:model.live="filterCreatedDay" />
                            </div>
                            <div class="col-12 col-sm-6 col-md-auto">
                                <label class="form-label small text-muted mb-1">Month</label>
                                <input type="month" class="form-control form-control-sm" wire:model.live="filterCreatedMonth" />
                            </div>
                            <div class="col-12 col-sm-6 col-md-auto">
                                <label class="form-label small text-muted mb-1">From</label>
                                <input type="date" class="form-control form-control-sm" wire:model.live="filterCreatedFrom" />
                            </div>
                            <div class="col-12 col-sm-6 col-md-auto">
                                <label class="form-label small text-muted mb-1">To</label>
                                <input type="date" class="form-control form-control-sm" wire:model.live="filterCreatedTo" />
                            </div>
                            <div class="col-12 col-md-auto">
                                <button type="button" class="btn btn-sm btn-outline-secondary" wire:click="clearDateFilters">
                                    Clear dates
                                </button>
                            </div>
                        </div>
                        <p class="text-muted small mb-0 mt-2">
                            Filters by <strong>created</strong> date. If a single date is set, month and range are ignored. Otherwise month overrides range.
                        </p>
                    </div>

                    <div class="card-table table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Task</th>
                                    <th>Category</th>
                                    <th>Member</th>
                                    <th>Deadline</th>
                                    <th>Status</th>
                                    <th>Score</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $index => $task)
                                    <tr>
                                        <td>{{ ($tasks->currentPage() - 1) * $tasks->perPage() + $index + 1 }}</td>
                                        <td>{{ $task->name }}</td>
                                        <td>{{ $task->category?->name }}</td>
                                        <td>
                                            @if ($task->assignedUser)
                                                {{ $task->assignedUser->name }} ({{ $task->assignedUser->reg_no }})
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($task->deadline_at)
                                                {{ $task->deadline_at->format('Y-m-d H:i') }}
                                            @else
                                                -
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
                                        <td class="d-flex flex-wrap gap-2">
                                            @if (
                                                (($section === 'pending_assignment' && $task->status === \App\Models\Task::STATUS_UNASSIGNED) ||
                                                    ($section === 'all' && in_array($task->status, [
                                                        \App\Models\Task::STATUS_UNASSIGNED,
                                                        \App\Models\Task::STATUS_ASSIGNED,
                                                        \App\Models\Task::STATUS_SUBMITTED,
                                                    ], true))) &&
                                                    !$task->is_expired
                                            )
                                                <button type="button" class="btn btn-warning btn-sm"
                                                    wire:click="openAssignModal({{ $task->id }})">Assign</button>
                                            @endif

                                            @if ($section === 'completed')
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('admin.task.edit', $task->id) }}">DETAIL</a>
                                            @elseif ($section === 'assignment_complete')
                                                <a class="btn btn-success btn-sm"
                                                    href="{{ route('admin.task.edit', $task->id) }}">APPROVE</a>
                                                <a class="btn btn-danger btn-sm"
                                                    href="{{ route('admin.task.edit', $task->id) }}">REJECT</a>
                                                <button class="btn btn-danger btn-sm" wire:click='delete({{ $task->id }})'
                                                    wire:confirm="Are you sure you want to delete this task?"
                                                    type="button">DELETE</button>
                                            @elseif ($section === 'approve' || $section === 'reject')
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('admin.task.edit', $task->id) }}">DETAIL</a>
                                                <button class="btn btn-danger btn-sm" wire:click='delete({{ $task->id }})'
                                                    wire:confirm="Are you sure you want to delete this task?"
                                                    type="button">DELETE</button>
                                            @elseif ($section === 'all')
                                                @if ($task->status === \App\Models\Task::STATUS_SUBMITTED)
                                                    <a class="btn btn-success btn-sm"
                                                        href="{{ route('admin.task.edit', $task->id) }}">APPROVE</a>
                                                    <a class="btn btn-danger btn-sm"
                                                        href="{{ route('admin.task.edit', $task->id) }}">REJECT</a>
                                                @elseif (in_array($task->status, [\App\Models\Task::STATUS_APPROVED, \App\Models\Task::STATUS_REJECTED], true))
                                                    <a class="btn btn-primary btn-sm"
                                                        href="{{ route('admin.task.edit', $task->id) }}">DETAIL</a>
                                                @else
                                                    <a class="btn btn-primary btn-sm"
                                                        href="{{ route('admin.task.edit', $task->id) }}">EDIT</a>
                                                @endif
                                                <button class="btn btn-danger btn-sm" wire:click='delete({{ $task->id }})'
                                                    wire:confirm="Are you sure you want to delete this task?"
                                                    type="button">DELETE</button>
                                            @else
                                                <a class="btn btn-primary btn-sm"
                                                    href="{{ route('admin.task.edit', $task->id) }}">EDIT</a>
                                                <button class="btn btn-danger btn-sm" wire:click='delete({{ $task->id }})'
                                                    wire:confirm="Are you sure you want to delete this task?"
                                                    type="button">DELETE</button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="pg_id">
                        {{ $tasks->links() }}
                    </div>
                </div>
            </div>
        </div>

        @if ($showAssignModal)
            <div class="modal fade show d-block" tabindex="-1" role="dialog" aria-modal="true"
                style="background-color: rgba(0, 0, 0, 0.45);">
                <div class="modal-dialog modal-dialog-scrollable modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Assign members</h5>
                            <button type="button" class="btn-close" wire:click="closeAssignModal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="text-muted small">Search by name or registration number, select one or more
                                members, then confirm.</p>

                            <div class="mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fi fi-rr-search"></i></span>
                                    <input type="text" class="form-control"
                                        wire:model.live.debounce.250ms="assignUserSearch"
                                        placeholder="Search by name or reg no..." autocomplete="off" />
                                </div>
                            </div>

                            @if (count($selectedUserIds) > 0)
                                <div class="mb-3">
                                    <span class="fw-semibold">Selected ({{ count($selectedUserIds) }})</span>
                                </div>
                            @endif

                            @if ($this->assignModalUserResults->count() > 0)
                                <div class="list-group mb-3" style="max-height: 280px; overflow: auto;">
                                    @foreach ($this->assignModalUserResults as $u)
                                        @php($isPicked = in_array((int) $u->id, array_map('intval', $selectedUserIds), true))
                                        <div
                                            wire:key="assign-user-row-{{ $u->id }}"
                                            wire:click="toggleAssignUser({{ $u->id }})"
                                            class="list-group-item list-group-item-action d-flex align-items-center gap-2"
                                            style="cursor: pointer;"
                                            role="button">
                                            {{-- Not a <label>: label+checkbox would native-toggle and fight Livewire (double toggle). --}}
                                            <input
                                                type="checkbox"
                                                class="form-check-input mt-0 flex-shrink-0"
                                                style="pointer-events: none;"
                                                tabindex="-1"
                                                @if ($isPicked) checked @endif
                                                aria-hidden="true" />
                                            <span>{{ $u->name }} <span class="text-muted">({{ $u->reg_no }})</span></span>
                                        </div>
                                    @endforeach
                                </div>
                            @elseif (strlen(trim($assignUserSearch)) > 0)
                                <p class="text-muted small mb-0">No users match this search.</p>
                            @endif

                            @error('selectedUserIds')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" wire:click="closeAssignModal">Cancel</button>
                            <button type="button" class="btn btn-primary" wire:click="assignSelectedUsers"
                                wire:loading.attr="disabled">Confirm assign</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

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

        @if (session('task_flash_success'))
            <script>
                window.addEventListener('load', function() {
                    window.dispatchEvent(new CustomEvent('success_alert', {
                        detail: [{
                            title: @json(session('task_flash_success'))
                        }]
                    }));
                });
            </script>
        @endif
</div>
