<div>
    <livewire:comp.breadcumb title="TASKS" section="My work" sub="Task Details" action="View">
        <div class="edash-content-section row g-3 g-md-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex flex-column flex-md-row justify-content-between gap-2">
                        <div>
                            <h4 class="card-title mb-1">{{ $task->name }}</h4>
                            <div class="small text-muted">
                                Category: {{ $task->category?->name ?? '—' }}
                                @if ($task->deadline_at)
                                    · Deadline: {{ $task->deadline_at->format('Y-m-d H:i') }}
                                @endif
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('task.my-tasks') }}" class="btn btn-light text-danger">Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="mb-3">
                            @if ($task->is_expired)
                                <span class="badge bg-danger">Expired</span>
                            @else
                                <span class="badge bg-primary">{{ $task->status }}</span>
                            @endif
                            <span class="ms-2 text-muted small">Max score: {{ $task->max_score }}</span>
                        </div>

                        <div class="border rounded p-3 bg-body-tertiary">
                            @if (!empty($task->description))
                                {!! $task->description !!}
                            @else
                                <span class="text-muted">No description provided.</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </livewire:comp.breadcumb>
</div>

