<div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Create New Criteria</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="save">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Criteria Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" wire:model="name" placeholder="Enter criteria name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="count">Count <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('count') is-invalid @enderror"
                                   id="count" wire:model="count" min="1" placeholder="Enter count">
                            @error('count')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" wire:model="description" rows="3"
                                      placeholder="Enter criteria description"></textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror"
                                    id="status" wire:model="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">Create Criteria</button>
                    <a href="{{ route('admin.criteria.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
