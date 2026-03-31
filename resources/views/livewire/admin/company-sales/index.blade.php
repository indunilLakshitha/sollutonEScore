<div>
    <livewire:comp.breadcumb title="COMPANY" section="Admin" sub="Monthly Sales Count" action="Set">
        <div class="edash-content-section row g-3 g-md-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Company Monthly Sales Count</h4>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-4">
                            Enter the total company sales count and the month it applies to (one saved row per month). Income calculations use this value for that calendar month.
                        </p>

                        <div class="row g-4 mb-3">
                            <div class="col-md-3">
                                <label class="fw-semibold text-muted" for="company_sales_entry_month">Month</label>
                            </div>
                            <div class="col-md-4">
                                <input id="company_sales_entry_month" type="month" class="form-control"
                                    wire:model="salesEntryMonth"
                                    min="2026-01" max="2050-12" />
                            </div>
                        </div>
                        @error('salesEntryMonth')
                            <div style="color: red" class="mb-2">{{ $message }}</div>
                        @enderror

                        <div class="row g-4 mb-3">
                            <div class="col-md-3">
                                <label class="fw-semibold text-muted" for="company_sales_entry_count">Sales count</label>
                            </div>
                            <div class="col-md-4">
                                <input id="company_sales_entry_count" type="number" class="form-control" min="0"
                                    max="100000000" wire:model="salesCountEntry"
                                    placeholder="Sales count for selected month" />
                            </div>
                        </div>
                        @error('salesCountEntry')
                            <div style="color: red" class="mb-2">{{ $message }}</div>
                        @enderror

                        <div class="row g-4 mb-4">
                            <div class="col-md-3"></div>
                            <div class="col-md-9 d-flex gap-2">
                                <button class="btn btn-primary" type="button" wire:click="save">SAVE</button>
                            </div>
                        </div>

                        @php($monthNames = [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec'])
                        @if (! empty($companySalesRows))
                            <div class="table-responsive border rounded">
                                <table class="table table-sm mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Month</th>
                                            <th class="text-end">Sales count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($companySalesRows as $row)
                                            <tr wire:key="company-sales-row-{{ $row['year'] }}-{{ $row['month'] }}">
                                                <td>{{ $row['year'] }} — {{ $monthNames[$row['month']] ?? $row['month'] }}</td>
                                                <td class="text-end">{{ number_format($row['sales_count']) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </livewire:comp.breadcumb>
</div>
