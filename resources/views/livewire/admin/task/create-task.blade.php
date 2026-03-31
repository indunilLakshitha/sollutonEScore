<div>
    <livewire:comp.breadcumb title="TASKS" section="Admin" sub="Task Management" action="Add">
        <div>
            <div class="edash-page-container container-xxl" id="edash-page-container">
                <div class="edash-content-section">
                    <div class="d-flex gap-3 gap-md-4">
                        <div class="edash-settings-content card w-100 overflow-hidden">
                            <div class="card-body">
                                <p class="text-muted small mb-4">
                                    Optionally assign by <strong>role</strong> (all active users in that role) and/or pick
                                    individual members (each gets their own copy). Leave both empty to create a single
                                    unassigned task and use <strong>Assign</strong> on the task list later.
                                </p>
                                <form wire:submit="save">
                                    <hr class="my-12 border-top-dashed" />

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
                                            <label class="fw-semibold text-muted" for="task_description_editor">Task description</label>
                                            <p class="small text-muted mb-0">Supports rich text (bold, lists, etc.).</p>
                                        </div>
                                        <div class="col-md-9">
                                            <div wire:ignore>
                                                <textarea id="task_description_editor_create" class="form-control"></textarea>
                                            </div>
                                            <input type="hidden" wire:model.defer="description" />
                                        </div>
                                        @error('description')
                                            <div style="color: red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted" for="task_category">Category</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select id="task_category" class="form-select" wire:model='taskCategoryId'>
                                                <option value="0">SELECT</option>
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

                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3">
                                            <span class="fw-semibold text-muted">Assign members</span>
                                            <p class="small text-muted mb-0">Optional</p>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="mb-3">
                                                <span class="fw-semibold small d-block mb-2">Assign by role</span>
                                                <p class="text-muted small mb-2">Tick a role to assign this task to every <strong>active</strong> user in that role (in addition to anyone you pick below).</p>
                                                <div class="d-flex flex-wrap gap-3">
                                                    @foreach ($assignRoles as $role)
                                                        <div class="form-check" wire:key="create-assign-role-{{ $role->id }}">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="create-assign-role-cb-{{ $role->id }}"
                                                                value="{{ (int) $role->id }}"
                                                                wire:model.live="selectedRoleIds">
                                                            <label class="form-check-label" for="create-assign-role-cb-{{ $role->id }}">
                                                                {{ $role->name }}
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <span class="fw-semibold small d-block mb-2">Or pick members</span>
                                                <div class="input-group">
                                                    <span class="input-group-text"><i class="fi fi-rr-search"></i></span>
                                                    <input type="text" class="form-control"
                                                        wire:model.live.debounce.250ms="assignUserSearch"
                                                        placeholder="Search by name or reg no..." autocomplete="off" />
                                                </div>
                                            </div>

                                            @if (count($selectedUserIds) > 0)
                                                <div class="mb-2">
                                                    <span class="fw-semibold small">Selected
                                                        ({{ count($selectedUserIds) }})</span>
                                                </div>
                                            @endif

                                            @if ($this->assignModalUserResults->count() > 0)
                                                <div class="list-group mb-2" style="max-height: 260px; overflow: auto;">
                                                    @foreach ($this->assignModalUserResults as $u)
                                                        @php($isPicked = in_array((int) $u->id, array_map('intval', $selectedUserIds), true))
                                                        <button wire:key="create-assign-user-{{ $u->id }}"
                                                            wire:click="toggleAssignUser({{ $u->id }})"
                                                            class="list-group-item list-group-item-action d-flex align-items-center gap-2"
                                                            style="cursor: pointer;" type="button">
                                                            <input type="checkbox"
                                                                class="form-check-input mt-0 flex-shrink-0"
                                                                style="pointer-events: none;" tabindex="-1"
                                                                @if ($isPicked) checked @endif
                                                                aria-hidden="true" />
                                                            <span>{{ $u->name }} <span
                                                                    class="text-muted">({{ $u->reg_no }})</span></span>
                                                        </button>
                                                    @endforeach
                                                </div>
                                            @elseif (strlen(trim($assignUserSearch)) > 0)
                                                <p class="text-muted small mb-0">No users match this search.</p>
                                            @endif

                                            @foreach ($errors->get('selectedUserIds') as $msg)
                                                <div class="text-danger small">{{ $msg }}</div>
                                            @endforeach
                                            @foreach ($errors->get('selectedUserIds.*') as $msg)
                                                <div class="text-danger small">{{ $msg }}</div>
                                            @endforeach
                                            @foreach ($errors->get('selectedRoleIds') as $msg)
                                                <div class="text-danger small">{{ $msg }}</div>
                                            @endforeach
                                            @foreach ($errors->get('selectedRoleIds.*') as $msg)
                                                <div class="text-danger small">{{ $msg }}</div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <hr class="my-12 border-top-dashed" />

                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-9 d-flex gap-2">
                                            <a href="{{ route('admin.task.index') }}"
                                                class="btn btn-light text-danger">Back</a>
                                            <button class="btn btn-primary" type="submit">SAVE</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

@push('modals')
    <script>
        document.addEventListener('livewire:init', function() {
            var el = document.getElementById('task_description_editor_create');
            if (!el || typeof $ === 'undefined' || typeof $(el).summernote !== 'function') return;
            if ($(el).data('summernote')) return;

            $(el).summernote({
                height: 220,
                callbacks: {
                    onChange: function(contents) {
                        try {
                            @this.set('description', contents);
                        } catch (e) {}
                    }
                }
            });

            $(el).summernote('code', @js($description));
        });
    </script>
@endpush
