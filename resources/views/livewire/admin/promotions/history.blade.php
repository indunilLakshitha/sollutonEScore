<div>
    <!--! Start:: Breadcumb !-->
    <livewire:comp.breadcumb title="RANKING HISTORY" section="Admin" sub="Ranking" action="History">
        <!--! End:: Breadcumb !-->
        <div class="edash-content-section row g-3 g-md-4">
            <!-- Start:: Filter -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="#" class="form-group" id="historyFilter">
                            <div class="form-group row mb-4">
                                <div class="col-lg-3 mb-2 mb-md-0">
                                    <label class="form-label">Search:</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fi fi-rr-search"></i></span>
                                        <input type="text" class="form-control" wire:model='search'
                                            wire:input='searchUsers' placeholder="Search by user or ranking name...">
                                    </div>
                                    <div class="panel-footer">
                                        @foreach ($availableUsers as $user)
                                            <div style="width: 400px; background-color : white">

                                                <ul class="list-group"  wire:click='selectUser({{ $user->id }})'
                                                    style="max-height: 200px; overflow-y: auto; padding: 10px; font-color : black">
                                                    <li class="list-group-item"> (ID:
                                                        {{ $user->id }})</li>
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-lg-3 mb-2 mb-md-0">
                                    <label class="form-label">Ranking:</label>
                                    <select class="form-select" wire:model='promotionFilter' wire:change='filter'>
                                        <option value="">All Ranking</option>
                                        @foreach ($promotions as $promotion)
                                            <option value="{{ $promotion->id }}">{{ $promotion->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- <div class="col-lg-3 mb-2 mb-md-0">
                                    <label class="form-label">User:</label>
                                    <select class="form-select" wire:model='userFilter' wire:change='filter'>
                                        <option value="">All Users</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"></option>
                                        @endforeach
                                    </select>
                                </div> --}}

                                <div class="col-lg-3 mb-2 mb-md-0 pt-1">
                                    <label class="form-label">&nbsp;</label>
                                    <div>
                                        <button type="button" class="btn btn-primary" wire:click="runRankingCron"
                                            @if($isRunning) disabled @endif>
                                            @if($isRunning)
                                                Running Ranking Update...
                                            @else
                                                Run Ranking Update
                                            @endif
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End:: Filter -->

            <!-- Start:: Zero Config -->
            <div class="col-12">
                <div class="card">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="card-header">
                            <h4 class="card-title">Ranking History</h4>
                        </div>
                    </div>
                    <div class="card-table table-responsive">
                        <table id="" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>User</th>
                                    <th>Rank</th>
                                    <th>Achieved Date</th>
                                    <th>Reward</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($histories as $history)
                                    <tr>
                                        <td>{{ $loop->iteration + ($histories->currentPage() - 1) * $histories->perPage() }}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-0">{{ $history->user->name ?? 'N/A' }}</h6>
                                                    <small
                                                        class="text-muted">{{ $history->user->email ?? 'N/A' }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if ($history->promotion->image)
                                                    <img src="{{ asset('storage/' . $history->promotion->image) }}"
                                                        alt="{{ $history->promotion->name }}" class="rounded"
                                                        style="width: 50px; height: auto;">
                                                @endif
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-0">{{ $history->promotion->name ?? 'N/A' }}</h6>
                                                    <small class="text-muted">Sales:
                                                        {{ $history->promotion->sales_target }} | Income:
                                                        {{ $history->promotion->income_target }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $history->achived_at ? $history->achived_at->format('Y M d') : 'N/A' }}
                                        </td>
                                        <td>
                                            @if ($history->promotion->reward_name)
                                                <span class="badge bg-success">Reward:
                                                    {{ $history->promotion->reward_name }}</span>
                                            @else
                                                <span class="badge bg-secondary">No Reward</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No promotion history found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>No</th>
                                    <th>User</th>
                                    <th>Ranking</th>
                                    <th>Achieved Date</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div id="pg_id">
                        {{ $histories->links() }}
                    </div>
                </div>
            </div>
            <!-- End:: Zero Config -->
        </div>
        <style>
            .main-color {
                color: green
            }

            .dummy-color {
                color: orange
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

            .panel-footer {
                position: absolute;
                width: calc(100% - 30px);
                z-index: 9;
            }
        </style>

        @script
        <script>
            $wire.on('run-ranking-cron', () => {
                // Show a confirmation dialog
                if (confirm('Are you sure you want to run the ranking update for all users? This may take a while.')) {
                    // Make an AJAX request to run the command
                    fetch('/admin/promotions/run-ranking-cron', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Ranking update started successfully in the background! It may take a while to complete.');
                        } else {
                            alert('Error running ranking update: ' + data.message);
                        }
                        // Reset the button state
                        $wire.isRunning = false;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error running ranking update. Please check the console for details.');
                        $wire.isRunning = false;
                    });
                } else {
                    // Reset the button state if cancelled
                    $wire.isRunning = false;
                }
            });
        </script>
        @endscript
    </div>
