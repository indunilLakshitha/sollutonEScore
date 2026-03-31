<div>
    <livewire:comp.breadcumb title="MEMBERS" section="Admin" sub="Member Management" action="All">
        <div class="edash-content-section row g-3 g-md-4">
            <div class="col-12">
                <div class="card">
                    <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3 gap-md-0">
                        <div class="card-header">
                            <h4 class="card-title">Members</h4>
                        </div>
                        <div class="card-header d-flex flex-wrap flex-md-nowrap align-items-center justify-content-end gap-3 w-100 w-md-auto">
                            <div class="input-group w-100 w-md-auto member-search">
                                <span class="input-group-text"><i class="fi fi-rr-search"></i></span>
                                <input type="text" class="form-control" wire:model.live="search"
                                    placeholder="Search name / ER / username / phone..." />
                            </div>
                            <a href="{{ route('admin.member.create') }}"
                                class="btn btn-md btn-primary w-100 w-sm-auto w-md-auto">ADD</a>
                        </div>
                    </div>

                    <div class="card-table table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>ER No</th>
                                    <th>Email</th>
                                    <th>Role / position</th>
                                    <th>Phone</th>
                                    <th>Fixed salary</th>
                                    <th>Salary amount</th>
                                    <th>Status</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($members as $index => $user)
                                    <tr>
                                        <td>{{ ($members->currentPage() - 1) * $members->perPage() + $index + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->reg_no }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->role?->name ?? ($user->position ?? '—') }}</td>
                                        <td>{{ $user->mobile_no }}</td>
                                        <td>
                                            {{ (int) ($user->fixed_salary ?? 0) === 1 ? 'Yes' : 'No' }}
                                        </td>
                                        <td>
                                            @if ((int) ($user->fixed_salary ?? 0) === 1 && isset($user->salary_amount) && $user->salary_amount !== null)
                                                {{ number_format((float) $user->salary_amount, 2) }}
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ((int) $user->active_status === \App\Models\User::BLOCKED)
                                                <span class="badge bg-danger">INACTIVE</span>
                                            @else
                                                <span class="badge bg-success">ACTIVE</span>
                                            @endif
                                        </td>
                                        <td class="d-flex gap-2">
                                            <a class="btn btn-primary"
                                                href="{{ route('admin.member.edit', $user->id) }}" type="button">
                                                EDIT
                                            </a>
                                            @if ((int) $user->is_admin != 1)
                                                @if ((int) $user->active_status === \App\Models\User::BLOCKED)
                                                    <button class="btn btn-warning"
                                                        wire:click='toggleActive({{ $user->id }})' type="button">
                                                        EENABLE
                                                    </button>
                                                @else
                                                    <button class="btn btn-warning"
                                                        wire:click='toggleActive({{ $user->id }})' type="button">
                                                        DISABLE
                                                    </button>
                                                @endif
                                                <button class="btn btn-danger" wire:click='delete({{ $user->id }})'
                                                    wire:confirm="Are you sure you want to delete this member?"
                                                    type="button">
                                                    DELETE
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
            @media (min-width: 768px) {
                .member-search {
                    min-width: 260px; /* restore original desktop sizing */
                }
            }

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
</div>
