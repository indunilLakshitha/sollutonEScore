<div>
    <livewire:comp.breadcumb title="TASKS" section="My work" sub="My Tasks" action="All">
        <div class="edash-content-section row g-3 g-md-4">
            <div class="col-12">
                <div class="card">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div class="card-header">
                            <h4 class="card-title mb-0">My Tasks</h4>
                            <p class="text-muted small mb-0 mt-1">Tasks assigned to you. Mark as done when finished — then admins can approve or reject in Task Management.</p>
                        </div>
                        <div class="card-header d-flex align-items-center gap-2 flex-wrap">
                            <select class="form-select" style="min-width: 220px" wire:model.live="filter">
                                <option value="">All</option>
                                <option value="pending">Pending</option>
                                <option value="expired">Expired</option>
                                <option value="completed">Assignment complete</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                        </div>
                    </div>

                    <div class="card-table table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Task</th>
                                    <th>Category</th>
                                    <th>Deadline</th>
                                    <th>Status</th>
                                    <th>Score</th>
                                    <th style="min-width: 320px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $index => $task)
                                    <tr wire:key="my-task-{{ $task->id }}">
                                        <td>{{ ($tasks->currentPage() - 1) * $tasks->perPage() + $index + 1 }}</td>
                                        <td>{{ $task->name }}</td>
                                        <td>{{ $task->category?->name }}</td>
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
                                        <td>
                                            @if ($task->status === \App\Models\Task::STATUS_ASSIGNED || $task->status === \App\Models\Task::STATUS_REJECTED)
                                                <div class="d-flex flex-column flex-sm-row gap-2 align-items-stretch">
                                                    <input type="text" class="form-control"
                                                        wire:model="notes.{{ $task->id }}"
                                                        placeholder="Optional note..." />
                                                    <button class="btn btn-success text-nowrap" type="button"
                                                        wire:click="markAsDone({{ $task->id }})"
                                                        wire:loading.attr="disabled">Mark as done</button>
                                                </div>
                                            @else
                                                <div class="text-muted small mb-0">
                                                    {{ $task->submission_note ?: '—' }}
                                                </div>
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
