<div>
    <livewire:comp.breadcumb title="COMPANY" section="Admin" sub="Monthly Sales Count" action="Set">
        <div class="edash-content-section row g-3 g-md-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Company Monthly Sales Count</h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-4 mb-4">
                            <div class="col-md-3">
                                <label class="fw-semibold text-muted" for="company_sales_year">Year</label>
                            </div>
                            <div class="col-md-3">
                                <input id="company_sales_year" type="number" class="form-control" min="2000"
                                    max="2100" wire:model.live="year" />
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <span class="text-muted small">Set one monthly total sales count value for the whole company.</span>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            @php($monthNames = [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'])
                            @foreach ($monthNames as $monthNo => $monthLabel)
                                <div class="col-md-3 col-sm-6">
                                    <label class="form-label small text-muted mb-1" for="company_sales_{{ $monthNo }}">{{ $monthLabel }}</label>
                                    <input id="company_sales_{{ $monthNo }}" type="number" class="form-control" min="0"
                                        wire:model="salesCountInputs.{{ $monthNo }}" placeholder="Sales count" />
                                </div>
                            @endforeach
                        </div>

                        @error('year')
                            <div style="color: red" class="mb-2">{{ $message }}</div>
                        @enderror
                        @error('salesCountInputs.*')
                            <div style="color: red" class="mb-2">{{ $message }}</div>
                        @enderror

                        <div class="row g-4 mb-0">
                            <div class="col-md-3"></div>
                            <div class="col-md-9 d-flex gap-2">
                                <button class="btn btn-primary" type="button" wire:click="save">SAVE</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </livewire:comp.breadcumb>
</div>
