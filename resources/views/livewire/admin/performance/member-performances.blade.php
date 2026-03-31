<div x-data>
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
                                                @php($draftType = $bonusTypeDrafts[(int) $row->id] ?? ($row->bonus_type_saved ?? '__clear__'))
                                                <select class="form-select form-select-sm" style="min-width: 140px"
                                                    wire:model.live="bonusTypeDrafts.{{ (int) $row->id }}">
                                                    <option value="__clear__">— Select —</option>
                                                    <option value="cash">Cash</option>
                                                    <option value="gift">Gift</option>
                                                </select>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td style="min-width: 220px">
                                            @if ($row->bonus_eligible)
                                                @if ($draftType === 'cash')
                                                    <input type="number" step="0.01" class="form-control form-control-sm"
                                                        placeholder="Cash amount"
                                                        wire:model.defer="bonusCashAmountDrafts.{{ (int) $row->id }}" />
                                                @elseif ($draftType === 'gift')
                                                    <input type="text" class="form-control form-control-sm"
                                                        placeholder="Gift name"
                                                        wire:model.defer="bonusGiftNameDrafts.{{ (int) $row->id }}" />
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
                                            @if ($row->bonus_eligible)
                                                <button class="btn btn-sm btn-success ms-1 mt-1 mt-sm-0"
                                                    type="button"
                                                    wire:click="saveBonusDraft({{ (int) $row->id }})"
                                                    wire:loading.attr="disabled">
                                                    SAVE BONUS
                                                </button>
                                            @else
                                                <button class="btn btn-sm btn-warning ms-1 mt-1 mt-sm-0"
                                                    type="button"
                                                    @click.prevent="
                                                        if (typeof Swal === 'undefined') {
                                                            const type = prompt('Bonus type: cash or gift', 'cash');
                                                            if (!type) return;
                                                            const details = prompt(type === 'cash' ? 'Cash amount' : 'Gift name');
                                                            if (details === null) return;
                                                            $wire.giveBonusOverride({{ (int) $row->id }}, type, details);
                                                            return;
                                                        }

                                                        const userLabel = @js($row->name . ' (' . $row->reg_no . ')');
                                                        Swal.fire({
                                                            title: 'Give bonus (override)',
                                                            html: `
                                                                <div class=&quot;text-start&quot;>
                                                                    <div class=&quot;mb-2 small text-muted&quot;>${userLabel}</div>
                                                                    <label class=&quot;form-label&quot;>Bonus type</label>
                                                                    <select id=&quot;bonusType&quot; class=&quot;form-select mb-3&quot;>
                                                                        <option value=&quot;cash&quot;>Cash</option>
                                                                        <option value=&quot;gift&quot;>Gift</option>
                                                                    </select>
                                                                    <label class=&quot;form-label&quot; id=&quot;bonusDetailsLabel&quot;>Cash amount</label>
                                                                    <input id=&quot;bonusDetails&quot; class=&quot;form-control&quot; placeholder=&quot;Enter cash amount&quot; />
                                                                </div>
                                                            `,
                                                            icon: 'question',
                                                            showCancelButton: true,
                                                            confirmButtonText: 'Save',
                                                            cancelButtonText: 'Cancel',
                                                            didOpen: () => {
                                                                const typeEl = document.getElementById('bonusType');
                                                                const labelEl = document.getElementById('bonusDetailsLabel');
                                                                const detailsEl = document.getElementById('bonusDetails');
                                                                const sync = () => {
                                                                    const t = typeEl.value;
                                                                    if (t === 'cash') {
                                                                        labelEl.textContent = 'Cash amount';
                                                                        detailsEl.type = 'number';
                                                                        detailsEl.step = '0.01';
                                                                        detailsEl.placeholder = 'Enter cash amount';
                                                                    } else {
                                                                        labelEl.textContent = 'Gift name';
                                                                        detailsEl.type = 'text';
                                                                        detailsEl.removeAttribute('step');
                                                                        detailsEl.placeholder = 'Enter gift name';
                                                                    }
                                                                };
                                                                typeEl.addEventListener('change', sync);
                                                                sync();
                                                            },
                                                            preConfirm: () => {
                                                                const type = document.getElementById('bonusType').value;
                                                                const details = document.getElementById('bonusDetails').value;
                                                                if (!details || details.trim() === '') {
                                                                    Swal.showValidationMessage('Bonus details are required.');
                                                                    return false;
                                                                }
                                                                if (type === 'cash' && isNaN(Number(details))) {
                                                                    Swal.showValidationMessage('Cash amount must be a number.');
                                                                    return false;
                                                                }
                                                                return { type, details };
                                                            }
                                                        }).then((result) => {
                                                            if (result.isConfirmed && result.value) {
                                                                Swal.close();
                                                                $wire.giveBonusOverride({{ (int) $row->id }}, result.value.type, result.value.details);
                                                            }
                                                        });
                                                    ">
                                                    GIVE BONUS
                                                </button>
                                            @endif
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
