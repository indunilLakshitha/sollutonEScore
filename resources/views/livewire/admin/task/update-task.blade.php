<div>
    <livewire:comp.breadcumb title="TASKS" section="Admin" sub="Task Management" action="Edit">
        @php($isCompleted = in_array($status, [\App\Models\Task::STATUS_APPROVED, \App\Models\Task::STATUS_REJECTED], true))
        @php($isApprovalPending = $status === \App\Models\Task::STATUS_SUBMITTED)
        <div>
            <div class="edash-page-container container-xxl" id="edash-page-container">
                <div class="edash-content-section">
                    <div class="d-flex gap-3 gap-md-4">
                        <div class="edash-settings-content card w-100 overflow-hidden">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <div>
                                        @if ($isExpired)
                                            <span class="badge bg-danger">Expired</span>
                                        @else
                                            <span class="badge bg-primary">{{ $status }}</span>
                                        @endif
                                    </div>
                                    <div class="text-muted">Max score: {{ $maxScore }}</div>
                                </div>

                                <div class="row g-4 mb-4">
                                    <div class="col-md-3">
                                        <span class="fw-semibold text-muted">Assigned member</span>
                                    </div>
                                    <div class="col-md-9">
                                        @if ($assignedUserLabel)
                                            {{ $assignedUserLabel }}
                                        @elseif ($status === \App\Models\Task::STATUS_UNASSIGNED)
                                            <span class="text-muted">Not assigned — use <strong>Assign</strong> on the task list.</span>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </div>
                                </div>

                                <form wire:submit="save">
                                    <fieldset @if($isCompleted || $isApprovalPending) disabled @endif>
                                    <hr class="my-12 border-top-dashed" />

                                    @if ($isApprovalPending)
                                        <div class="alert alert-info mb-4">
                                            Task/member details are locked while this task is awaiting approval.
                                        </div>
                                    @endif

                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted" for="task_name">Task Name</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="task_name" type="text" class="form-control" wire:model='name'
                                                placeholder="Task name" />
                                        </div>
                                        @error('name')
                                            <div style="color: red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted" for="task_category">Category</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select id="task_category" class="form-select" wire:model='taskCategoryId'>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('taskCategoryId')
                                            <div style="color: red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted" for="task_max_score">Score</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="task_max_score" type="number" class="form-control"
                                                wire:model='maxScore' placeholder="Max score" />
                                        </div>
                                        @error('maxScore')
                                            <div style="color: red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted" for="task_deadline">Deadline</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="task_deadline" type="datetime-local" class="form-control"
                                                wire:model='deadlineAt' />
                                        </div>
                                        @error('deadlineAt')
                                            <div style="color: red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <hr class="my-12 border-top-dashed" />

                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-9 d-flex gap-2">
                                            <a href="{{ route('admin.task.index') }}"
                                                class="btn btn-light text-danger">Back</a>
                                            @unless($isCompleted || $isApprovalPending)
                                                <button class="btn btn-primary" type="submit">SAVE</button>
                                            @endunless
                                        </div>
                                    </div>
                                    </fieldset>
                                </form>

                                <hr class="my-12 border-top-dashed" />

                                <div class="row g-4 mb-4">
                                    <div class="col-md-3">
                                        <label class="fw-semibold text-muted">Submission</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="border rounded p-3 bg-body-tertiary">
                                            {{ $submissionNote ?: '-' }}
                                        </div>
                                    </div>
                                </div>

                                @if ($status === \App\Models\Task::STATUS_SUBMITTED)
                                    @if (!$isExpired)
                                        <hr class="my-12 border-top-dashed" />

                                        <div class="row g-4 mb-4">
                                            <div class="col-md-3">
                                                <label class="fw-semibold text-muted"
                                                    for="task_score">Approve score</label>
                                            </div>
                                            <div class="col-md-9">
                                                <p class="text-muted small mb-2">Pre-filled with max score ({{ $maxScore }}). Change if needed before approving.</p>
                                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                                    <input id="task_score" type="number" class="form-control"
                                                        style="max-width: 200px"
                                                        wire:model.live="score"
                                                        min="0"
                                                        max="{{ $maxScore }}"
                                                        step="1"
                                                        placeholder="0 - {{ $maxScore }}" />
                                                    <button class="btn btn-success" type="button"
                                                        wire:click="approve">APPROVE</button>
                                                    <button class="btn btn-danger" type="button"
                                                        wire:click="reject">REJECT</button>
                                                </div>
                                            </div>
                                            @error('score')
                                                <div style="color: red">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @else
                                        <div class="alert alert-warning mb-0">
                                            This task is expired. Score is forced to 0.
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
