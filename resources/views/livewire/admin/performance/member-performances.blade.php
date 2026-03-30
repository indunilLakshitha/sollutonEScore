<div>
    <livewire:comp.breadcumb title="PERFORMANCE" section="Admin" sub="Member Performance" action="All">
        <div class="edash-content-section row g-3 g-md-4">
            <div class="col-12">
                <div class="card">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div class="card-header">
                            <h4 class="card-title">Member Performance & Income</h4>
                        </div>
                        <div class="card-header d-flex align-items-center gap-2 flex-wrap">
                            <input type="number" class="form-control" style="width: 120px" min="2000" max="2100"
                                wire:model.live="year" />
                            <select class="form-select" style="width: 130px" wire:model.live="month">
                                @for ($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}">{{ sprintf('%02d', $m) }}</option>
                                @endfor
                            </select>
                            <div class="input-group" style="min-width: 240px">
                                <span class="input-group-text"><i class="fi fi-rr-search"></i></span>
                                <input type="text" class="form-control" wire:model.live="search"
                                    placeholder="Search member / role..." />
                            </div>
                            {{-- APPROVE MONTHLY INCOME button removed.
                                 Performance/income are now updated when tasks are approved/rejected. --}}
                        </div>
                    </div>

                    <div class="card-table table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>ER No</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Performance (%)</th>
                                    <th>Sales Income</th>
                                    <th>Bonus Eligible</th>
                                    <th>Bonus (cash / gift)</th>
                                    <th>Bonus Details</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($members as $index => $row)
                                    <tr>
                                        <td>{{ ($members->currentPage() - 1) * $members->perPage() + $index + 1 }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->reg_no }}</td>
                                        <td>{{ $row->unique_id }}</td>
                                        <td>{{ $row->role_name }}</td>
                                        <td>{{ number_format((float) $row->performance, 2) }}%</td>
                                        <td>{{ number_format((float) $row->sales_income, 2) }}</td>
                                        <td>
                                            @if ($row->bonus_eligible)
                                                <span class="badge bg-success">Yes</span>
                                            @else
                                                <span class="text-muted">No</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($row->bonus_eligible)
                                                <select class="form-select form-select-sm" style="min-width: 140px"
                                                    wire:change="saveBonusType({{ (int) $row->id }}, $event.target.value)">
                                                    <option value="__clear__"
                                                        @selected(empty($row->bonus_type_saved))>— Select —</option>
                                                    <option value="cash"
                                                        @selected($row->bonus_type_saved === 'cash')>Cash</option>
                                                    <option value="gift"
                                                        @selected($row->bonus_type_saved === 'gift')>Gift</option>
                                                </select>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td style="min-width: 220px">
                                            @if ($row->bonus_eligible)
                                                @if ($row->bonus_type_saved === 'cash')
                                                    <input type="number" step="0.01" class="form-control form-control-sm"
                                                        placeholder="Cash amount"
                                                        value="{{ $row->bonus_cash_amount }}"
                                                        wire:change="saveBonusCashAmount({{ (int) $row->id }}, $event.target.value)" />
                                                @elseif ($row->bonus_type_saved === 'gift')
                                                    <input type="text" class="form-control form-control-sm"
                                                        placeholder="Gift name"
                                                        value="{{ $row->bonus_gift_name }}"
                                                        wire:change="saveBonusGiftName({{ (int) $row->id }}, $event.target.value)" />
                                                @else
                                                    <span class="text-muted small">Select Cash or Gift</span>
                                                @endif
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('admin.member-performance.tasks', $row->id) }}">VIEW TASKS</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div id="pg_id">
                        {{ $members->links() }}
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
