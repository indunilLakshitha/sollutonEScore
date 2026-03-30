<div>
    <livewire:comp.breadcumb title="PERFORMANCE" section="Admin" sub="Member Task Details" action="View">
        <div class="edash-content-section row g-3 g-md-4">
            <div class="col-12">
                <div class="card">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div class="card-header">
                            <h4 class="card-title mb-1">{{ $member->name }} ({{ $member->reg_no }})</h4>
                            <span class="text-muted small">Tasks for selected month</span>
                        </div>
                        <div class="card-header d-flex align-items-center gap-2 flex-wrap">
                            <input type="number" class="form-control" style="width: 120px" min="2000" max="2100"
                                wire:model.live="year" />
                            <select class="form-select" style="width: 130px" wire:model.live="month">
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}">{{ sprintf('%02d', $m) }}</option>
                                @endfor
                            </select>
                            <select class="form-select" style="width: 170px" wire:model.live="status">
                                <option value="">All statuses</option>
                                <option value="{{ \App\Models\Task::STATUS_ASSIGNED }}">Assigned</option>
                                <option value="{{ \App\Models\Task::STATUS_SUBMITTED }}">Submitted</option>
                                <option value="{{ \App\Models\Task::STATUS_APPROVED }}">Approved</option>
                                <option value="{{ \App\Models\Task::STATUS_REJECTED }}">Rejected</option>
                            </select>
                            <a href="{{ route('admin.member-performance.index') }}" class="btn btn-light">Back</a>
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
                                    <th>Submission Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tasks as $index => $task)
                                    <tr>
                                        <td>{{ ($tasks->currentPage() - 1) * $tasks->perPage() + $index + 1 }}</td>
                                        <td>{{ $task->name }}</td>
                                        <td>{{ $task->category?->name }}</td>
                                        <td>{{ $task->deadline_at ? $task->deadline_at->format('Y-m-d H:i') : '-' }}</td>
                                        <td>
                                            @if ($task->is_expired)
                                                <span class="badge bg-danger">Expired</span>
                                            @else
                                                <span class="badge bg-primary">{{ $task->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $task->score ?? '-' }} / {{ $task->max_score }}</td>
                                        <td>{{ $task->submission_note ?: '-' }}</td>
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
    </livewire:comp.breadcumb>
</div>
