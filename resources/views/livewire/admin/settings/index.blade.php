<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="SETTINGS" section="Admin" sub="Settings" action="All">
        <!--! End:: Breadcumb !-->
        <div class="edash-content-section row g-3 g-md-4">

            <div class="col-6">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
      
            <!-- End:: Zero Config -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Sales Income Multipliers</h4>
                    </div>

                    <div class="card-body">
                        <div class="row g-3 align-items-end">
                            <div class="col-md-4">
                                <label class="form-label">Management sales multiplier</label>
                                <input type="number" step="0.01" class="form-control"
                                    wire:model.live="management_sales_multiplier" />
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Director sales multiplier</label>
                                <input type="number" step="0.01" class="form-control"
                                    wire:model.live="director_sales_multiplier" />
                            </div>

                            <div class="col-md-4">
                                <button type="button" class="btn btn-primary w-100"
                                    wire:click="saveIncomeSalesMultipliers"
                                    wire:loading.attr="disabled">
                                    SAVE MULTIPLIERS
                                </button>
                            </div>
                        </div>
                        <p class="text-muted small mt-2 mb-0">
                            Used for management/director sales-based income calculations.
                        </p>
                    </div>
                </div>
            </div>
        </div>
</div>
