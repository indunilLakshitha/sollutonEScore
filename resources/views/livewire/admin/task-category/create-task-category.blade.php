<div>
    <livewire:comp.breadcumb title="TASKS" section="Admin" sub="Task Categories" action="Add">
        <div>
            <div class="edash-page-container container-xxl" id="edash-page-container">
                <div class="edash-content-section">
                    <div class="d-flex gap-3 gap-md-4">
                        <div class="edash-settings-content card w-100 overflow-hidden">
                            <div class="card-body">
                                <form wire:submit="save">
                                    <hr class="my-12 border-top-dashed" />

                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted" for="task_category_name">Name</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input id="task_category_name" type="text" class="form-control"
                                                wire:model='name' placeholder="Category name" />
                                        </div>
                                        @error('name')
                                            <div style="color: red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3">
                                            <label class="fw-semibold text-muted" for="task_category_active">Active</label>
                                        </div>
                                        <div class="col-md-9">
                                            <select id="task_category_active" class="form-select" wire:model='isActive'>
                                                <option value="1">TRUE</option>
                                                <option value="0">FALSE</option>
                                            </select>
                                        </div>
                                        @error('isActive')
                                            <div style="color: red">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <hr class="my-12 border-top-dashed" />

                                    <div class="row g-4 mb-4">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-9 d-flex gap-2">
                                            <a href="{{ route('admin.task-category.index') }}"
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

