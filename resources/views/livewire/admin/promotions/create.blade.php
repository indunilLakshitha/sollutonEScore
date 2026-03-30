<div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Create New Ranking</h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="save">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Ranking Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" wire:model="name" placeholder="Enter promotion name">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image">Ranking Image (1280x1280)</label>
                            <input type="file" accept="image/*" class="form-control @error('image') is-invalid @enderror" id="image" wire:model="image">
                            <small class="text-muted">Upload a square image exactly 1280 x 1280 pixels. Max 2MB.</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @if($image)
                                <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail mt-2" style="max-height: 160px;"/>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sales_target">Sales Target <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('sales_target') is-invalid @enderror"
                                   id="sales_target" wire:model="sales_target" placeholder="Enter sales target" min="0">
                            @error('sales_target')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sales_target_type">Sales Target Type <span class="text-danger">*</span></label>
                            <select class="form-control @error('sales_target_type') is-invalid @enderror"
                                    id="sales_target_type" wire:model="sales_target_type">
                                <option value="1">Monthly</option>
                                <option value="2">Yearly</option>
                                <option value="3">Total</option>
                            </select>
                            @error('sales_target_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="income_target">Income Target <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('income_target') is-invalid @enderror"
                                   id="income_target" wire:model="income_target" placeholder="Enter income target" min="0">
                            @error('income_target')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="income_target_type">Income Target Type <span class="text-danger">*</span></label>
                            <select class="form-control @error('income_target_type') is-invalid @enderror"
                                    id="income_target_type" wire:model="income_target_type">
                                <option value="1">Monthly</option>
                                <option value="2">Yearly</option>
                                <option value="3">Total</option>
                            </select>
                            @error('income_target_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="reward_name">Reward Name</label>
                            <input type="text" class="form-control @error('reward_name') is-invalid @enderror"
                                   id="reward_name" wire:model="reward_name" placeholder="Enter reward name">
                            @error('reward_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="has_downline_requirement">Downline Requirement</label>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="has_downline_requirement" wire:model="has_downline_requirement">
                                <label class="form-check-label" for="has_downline_requirement">Requires Downline (2 users)</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="direct_sale_count">New Direct Sale Count <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('direct_sale_count') is-invalid @enderror"
                                   id="direct_sale_count" wire:model="direct_sale_count" placeholder="Required direct sales" min="0">
                            @error('direct_sale_count')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="criteria">Criteria Requirements</label>
                            <div class="card">
                                <div class="card-body">
                                    @if($criterias->count() > 0)
                                        @foreach($criterias as $criteria)
                                            <div class="row mb-3 align-items-center">
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                               id="criteria_{{ $criteria->id }}"
                                                               wire:model="selected_criteria"
                                                               value="{{ $criteria->id }}">
                                                        <label class="form-check-label" for="criteria_{{ $criteria->id }}">
                                                            {{ $criteria->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-md-4">
                                                    <label class="form-label">Required Count:</label>
                                                    <input type="number" class="form-control"
                                                           wire:model="criteria_required_counts.{{ $criteria->id }}"
                                                           min="1" value="1"
                                                           {{ in_array($criteria->id, $selected_criteria) ? '' : 'disabled' }}>
                                                </div> --}}
                                                {{-- <div class="col-md-4">
                                                    <small class="text-muted">{{ $criteria->description }}</small>
                                                </div> --}}
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-muted">No criteria available.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Assign Courses Section -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h5 class="card-title mb-0">Assign Courses</h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted">Select courses that users must complete for this promotion</p>

                                <div class="row">
                                    @foreach(App\Models\Course::all() as $course)
                                        <div class="col-md-4 mb-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                       id="course_{{ $course->id }}"
                                                       wire:model="assigned_courses"
                                                       value="{{ $course->id }}">
                                                <label class="form-check-label" for="course_{{ $course->id }}">
                                                    {{ $course->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="required_promotions">Required Ranking</label>
                            <div class="card">
                                <div class="card-body">
                                    @if($availablePromotions->count() > 0)
                                        @foreach($availablePromotions as $promotion)
                                            <div class="row mb-3 align-items-center">
                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                               id="promotion_{{ $promotion->id }}"
                                                               wire:model="selected_required_promotions"
                                                               value="{{ $promotion->id }}">
                                                        <label class="form-check-label" for="promotion_{{ $promotion->id }}">
                                                            {{ $promotion->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Required Count:</label>
                                                    <input type="number" class="form-control"
                                                           wire:model="required_promotion_counts.{{ $promotion->id }}"
                                                           min="1" value="1"
                                                           >
                                                </div>
                                                {{-- <div class="col-md-4">
                                                    <small class="text-muted">
                                                        Sales: {{ $promotion->sales_target }} ({{ $promotion->sales_target_type == 1 ? 'Monthly' : ($promotion->sales_target_type == 2 ? 'Yearly' : 'Total') }})
                                                        <br>
                                                        Income: {{ $promotion->income_target }} ({{ $promotion->income_target_type == 1 ? 'Monthly' : ($promotion->income_target_type == 2 ? 'Yearly' : 'Total') }})
                                                    </small>
                                                </div> --}}
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-muted">No other Ranking available.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Create Ranking
                        </button>
                        <a href="{{ route('admin.promotions.index') }}" class="btn btn-secondary ms-2">
                            <i class="fas fa-arrow-left me-2"></i>Back to List
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
