<div>
    <!--! Start:: Breadcumb !-->
    <div class="edash-content-breadcumb row mb-4 mb-md-6 pt-md-2">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h2 class="h4 fw-semibold text-dark">Ranking</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">User</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">Ranking</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!--! End:: Breadcumb !-->

    <div class="edash-content-section row g-3 g-md-4">
        <!-- Start:: Filter -->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Date From:</label>
                            <input type="date" class="form-control" wire:model='date_from' wire:change='filter()'>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Date To:</label>
                            <input type="date" class="form-control" wire:model='date_to' wire:change='filter()'>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Promotion:</label>
                            <select class="form-control" wire:model='selected_promotion' wire:change='filter()'>
                                <option value="">All Promotions</option>
                                @foreach($promotions as $promotion)
                                    <option value="{{ $promotion->id }}">{{ $promotion->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="button" class="btn btn-primary" wire:click="filter()">
                                <i class="fi fi-rr-search me-2"></i>Filter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End:: Filter -->

        <!-- Start:: Stats Cards -->
        <div class="col-12">
            <div class="card-body">
                <div class="row g-3 g-md-4">
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between pd-5">
                                    <div class="avatar avatar-xl rounded bg-primary-subtle text-primary">
                                        <i class="fi fi-rr-trophy"></i>
                                    </div>
                                    <div class="text-end">
                                        <h4 class="fs-18 fw-semibold">{{ count($rankings) }}</h4>
                                        <span class="fs-13 text-muted">TOTAL USERS</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between pd-5">
                                    <div class="avatar avatar-xl rounded bg-success-subtle text-success">
                                        <i class="fi fi-rr-star"></i>
                                    </div>
                                    <div class="text-end">
                                        <h4 class="fs-18 fw-semibold">
                                            {{ $rankings ? collect($rankings)->sum('completed_promotions') : 0 }}
                                        </h4>
                                        <span class="fs-13 text-muted">COMPLETED PROMOTIONS</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between pd-5">
                                    <div class="avatar avatar-xl rounded bg-warning-subtle text-warning">
                                        <i class="fi fi-rr-sack-dollar"></i>
                                    </div>
                                    <div class="text-end">
                                        <h4 class="fs-18 fw-semibold">
                                            {{ env('CURRENCY') }}{{ number_format($rankings ? collect($rankings)->sum('total_earnings') : 0, 2) }}
                                        </h4>
                                        <span class="fs-13 text-muted">TOTAL EARNINGS</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center justify-content-between pd-5">
                                    <div class="avatar avatar-xl rounded bg-info-subtle text-info">
                                        <i class="fi fi-rr-chart-line-up"></i>
                                    </div>
                                    <div class="text-end">
                                        <h4 class="fs-18 fw-semibold">
                                            {{ $rankings ? round(collect($rankings)->avg('completion_rate'), 1) : 0 }}%
                                        </h4>
                                        <span class="fs-13 text-muted">AVG COMPLETION RATE</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End:: Stats Cards -->

        <!-- Start:: Rankings Table -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">User Rankings</h4>
                </div>
                <div class="card-table table-responsive">
                    <table id="rankingsTable" class="table mb-0">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>User</th>
                                <th>Total Promotions</th>
                                <th>Completed</th>
                                <th>Completion Rate</th>
                                <th>Total Earnings</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rankings as $ranking)
                                <tr class="{{ $ranking['user']->id === $user->id ? 'table-primary' : '' }}">
                                    <td>
                                        @if($ranking['rank'] <= 3)
                                            <span class="badge bg-warning fs-6">
                                                @if($ranking['rank'] == 1)
                                                    🥇
                                                @elseif($ranking['rank'] == 2)
                                                    🥈
                                                @else
                                                    🥉
                                                @endif
                                                {{ $ranking['rank'] }}
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">{{ $ranking['rank'] }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm rounded-circle bg-primary me-2">
                                                <span class="text-white fw-bold">
                                                    {{ strtoupper(substr($ranking['user']->name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $ranking['user']->name }}</div>
                                                <small class="text-muted">{{ $ranking['user']->email }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $ranking['total_promotions'] }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">{{ $ranking['completed_promotions'] }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress me-2" style="width: 60px; height: 8px;">
                                                <div class="progress-bar bg-success"
                                                     style="width: {{ $ranking['completion_rate'] }}%"></div>
                                            </div>
                                            <span class="fw-semibold">{{ $ranking['completion_rate'] }}%</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-semibold text-success">
                                            {{ env('CURRENCY') }}{{ number_format($ranking['total_earnings'], 2) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($ranking['user']->id === $user->id)
                                            <span class="badge bg-primary">YOU</span>
                                        @else
                                            <span class="badge bg-light text-dark">Other</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="fi fi-rr-trophy fs-2 mb-2"></i>
                                            <p>No rankings available</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Rank</th>
                                <th>User</th>
                                <th>Total Promotions</th>
                                <th>Completed</th>
                                <th>Completion Rate</th>
                                <th>Total Earnings</th>
                                <th>Status</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- End:: Rankings Table -->
    </div>

    <style>
        .table-primary {
            background-color: rgba(13, 110, 253, 0.1) !important;
        }

        .progress {
            background-color: #e9ecef;
            border-radius: 0.375rem;
        }

        .progress-bar {
            border-radius: 0.375rem;
        }

        .avatar {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
        }

        .avatar-sm {
            width: 1.5rem;
            height: 1.5rem;
        }

        .avatar-xl {
            width: 3rem;
            height: 3rem;
        }
    </style>
</div>
