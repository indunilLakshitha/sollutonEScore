<!--! ================================================================ !-->
<!--! Start:: Page Content !-->
<!--! ================================================================ !-->
<div id="dashboard-performance">
    <style>
        /* Scoped dashboard polish (no global side effects) */
        #dashboard-performance .kpi-card {
            border: 0;
            color: #fff;
            overflow: hidden;
            position: relative;
            box-shadow: 0 10px 30px rgba(16, 24, 40, 0.10);
        }
        #dashboard-performance .kpi-card .card-body {
            padding: 18px 18px;
        }
        #dashboard-performance .kpi-card .kpi-label {
            color: rgba(255, 255, 255, 0.85) !important;
        }
        #dashboard-performance .kpi-card .kpi-value {
            letter-spacing: -0.02em;
        }
        #dashboard-performance .kpi-card .kpi-icon {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.18);
            border: 1px solid rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(6px);
        }
        #dashboard-performance .kpi-card::after {
            content: "";
            position: absolute;
            right: -60px;
            top: -60px;
            width: 180px;
            height: 180px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.16);
        }
        #dashboard-performance .kpi-card::before {
            content: "";
            position: absolute;
            left: -70px;
            bottom: -70px;
            width: 220px;
            height: 220px;
            border-radius: 999px;
            background: rgba(0, 0, 0, 0.08);
        }
        #dashboard-performance .kpi-gradient-1 { background: linear-gradient(135deg, #2563eb 0%, #06b6d4 100%); }
        #dashboard-performance .kpi-gradient-2 { background: linear-gradient(135deg, #16a34a 0%, #22c55e 55%, #a3e635 100%); }
        #dashboard-performance .kpi-gradient-3 { background: linear-gradient(135deg, #7c3aed 0%, #ec4899 100%); }
        #dashboard-performance .kpi-gradient-4 { background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%); }

        #dashboard-performance .dash-section-card {
            border: 1px solid rgba(17, 24, 39, 0.08);
            box-shadow: 0 10px 30px rgba(16, 24, 40, 0.06);
        }
        #dashboard-performance .dash-section-card .card-header {
            background: linear-gradient(180deg, rgba(99, 102, 241, 0.10), rgba(255, 255, 255, 0));
            border-bottom: 1px solid rgba(17, 24, 39, 0.08);
        }
    </style>

    <div class="edash-content-breadcumb row mb-4 mb-md-6 pt-md-2">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h2 class="h4 fw-semibold text-dark">Summary</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0);">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Performance
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    @php($showCurrentMonthScores = (float) $currentAssignedTotal > 0)
    <div class="row g-3 g-md-4 mb-4">
        @if ($showCurrentMonthScores)
            <div class="col-md-3">
                <div class="card h-100 kpi-card kpi-gradient-2">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between gap-2">
                            <div>
                                <div class="kpi-label small">Current month approved score</div>
                                <div class="h4 mb-0 kpi-value">{{ number_format((float) $currentApprovedTotal, 2) }}</div>
                            </div>
                            <div class="kpi-icon" aria-hidden="true">
                                <span class="fw-bold">✓</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card h-100 kpi-card kpi-gradient-1">
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between gap-2">
                            <div>
                                <div class="kpi-label small">Current month assigned score</div>
                                <div class="h4 mb-0 kpi-value">{{ number_format((float) $currentAssignedTotal, 2) }}</div>
                            </div>
                            <div class="kpi-icon" aria-hidden="true">
                                <span class="fw-bold">≡</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="{{ $showCurrentMonthScores ? 'col-md-3' : 'col-md-6' }}">
            <div class="card h-100 kpi-card kpi-gradient-3">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between gap-2">
                        <div>
                            <div class="kpi-label small">Current month performance (%)</div>
                            <div class="h4 mb-0 kpi-value">{{ number_format($currentPerformance, 2) }}%</div>
                        </div>
                        <div class="kpi-icon" aria-hidden="true">
                            <span class="fw-bold">%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="{{ $showCurrentMonthScores ? 'col-md-3' : 'col-md-6' }}">
            <div class="card h-100 kpi-card kpi-gradient-4">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between gap-2">
                        <div>
                            <div class="kpi-label small">Current month actual income</div>
                            <div class="h4 mb-0 kpi-value">{{ number_format((float) $currentActualIncome, 2) }}</div>
                        </div>
                        <div class="kpi-icon" aria-hidden="true">
                            <span class="fw-bold">$</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 g-md-4 mb-4">
        <div class="col-12">
            <div class="card h-100 dash-section-card">
                <div class="card-header py-3 d-flex flex-wrap align-items-center justify-content-between gap-2">
                    <div>
                        <h5 class="card-title mb-0">Pending tasks</h5>
                        <div class="text-muted small mt-1 mb-0">Latest 5 tasks that need your action (same as My Tasks, Pending filter).</div>
                    </div>
                    <a href="{{ route('task.my-tasks') }}" class="btn btn-sm btn-outline-primary">View all</a>
                </div>
                <div class="card-body p-0">
                    @if ($pendingTasks->isEmpty())
                        <p class="text-muted small mb-0 p-3">No pending tasks right now.</p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover mb-0 align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">Task</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Deadline</th>
                                        <th scope="col" class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pendingTasks as $task)
                                        <tr>
                                            <td>
                                                <span class="fw-medium">{{ $task->name }}</span>
                                                @if ($task->is_expired)
                                                    <span class="badge bg-danger ms-1">Expired</span>
                                                @else
                                                    <span class="badge bg-secondary ms-1">{{ $task->status }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $task->category?->name ?? '—' }}</td>
                                            <td class="small text-muted">
                                                @if ($task->deadline_at)
                                                    {{ $task->deadline_at->format('Y-m-d H:i') }}
                                                @else
                                                    —
                                                @endif
                                            </td>
                                            <td class="text-end">
                                                <a href="{{ route('task.details', $task->id) }}" class="btn btn-sm btn-outline-primary">Details</a>
                                            </td>
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

    @if ($currentBonus)
        <div class="row g-3 g-md-4 mb-4">
            <div class="col-12">
                <div class="card border border-warning">
                    <div class="card-body d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between gap-3">
                        <div>
                            <div class="text-muted small">You have a bonus available (this month)</div>
                            <div class="fw-semibold">
                                @if ($currentBonus->bonus_type === \App\Models\UserMonthlyBonus::TYPE_CASH)
                                    Cash bonus: {{ number_format((float) ($currentBonus->cash_amount ?? 0), 2) }}
                                @elseif ($currentBonus->bonus_type === \App\Models\UserMonthlyBonus::TYPE_GIFT)
                                    Gift bonus: {{ $currentBonus->gift_name }}
                                @else
                                    Bonus available
                                @endif
                            </div>
                        </div>
                        <button type="button" class="btn btn-warning"
                            wire:click="claimBonus"
                            wire:loading.attr="disabled">
                            PICK BONUS
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if ((float) $currentFullIncome > 0 || (float) $currentActualIncome > 0)
        <div class="row g-3 g-md-4 mb-4">
            <div class="col-12">
                <div class="card h-100 dash-section-card">
                    <div class="card-header py-3">
                        <h5 class="card-title mb-0">Current month income — actual vs original</h5>
                        <div class="text-muted small mt-1 mb-0">Original is the full entitlement; actual reflects task performance.</div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap justify-content-between gap-2 small mb-2">
                            <div>
                                <span class="text-muted">Actual amount</span>
                                <div class="fw-semibold fs-5 text-primary">{{ number_format((float) $currentActualIncome, 2) }}</div>
                            </div>
                            <div class="text-end">
                                <span class="text-muted">Original amount</span>
                                <div class="fw-semibold fs-5">{{ number_format((float) $currentFullIncome, 2) }}</div>
                            </div>
                        </div>
                        <div class="progress rounded-pill overflow-hidden" style="height: 14px;">
                            <div class="progress-bar bg-primary" role="progressbar"
                                style="width: {{ min(100, max(0, (float) $incomeProgressPercent)) }}%;"
                                aria-valuenow="{{ (float) $incomeProgressPercent }}" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between mt-2 small text-muted">
                            <span>0</span>
                            <span>{{ number_format((float) $incomeProgressPercent, 1) }}% of original</span>
                            <span>{{ number_format((float) $currentFullIncome, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row g-3 g-md-4">
        <div class="col-lg-6">
            <div class="card h-100 dash-section-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Current Month Performance</h5>
                </div>
                <div class="card-body">
                    <canvas id="currentPerformanceChart" height="140"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card h-100 dash-section-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Performance Summary</h5>
                </div>
                <div class="card-body">
                    <canvas id="monthlyPerformanceChart" height="140"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card h-100 dash-section-card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Sales Based Income by Month</h5>
                </div>
                <div class="card-body">
                    <canvas id="monthlyIncomeChart" height="120"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener('load', function() {
            const currentCtx = document.getElementById('currentPerformanceChart');
            const monthlyCtx = document.getElementById('monthlyPerformanceChart');
            const incomeCtx = document.getElementById('monthlyIncomeChart');
            if (!currentCtx || !monthlyCtx || !incomeCtx || typeof Chart === 'undefined') {
                return;
            }

            if (window.__currentPerfChart) {
                window.__currentPerfChart.destroy();
            }
            if (window.__monthlyPerfChart) {
                window.__monthlyPerfChart.destroy();
            }
            if (window.__monthlyIncomeChart) {
                window.__monthlyIncomeChart.destroy();
            }

            window.__currentPerfChart = new Chart(currentCtx, {
                type: 'bar',
                data: {
                    labels: ['Current Month'],
                    datasets: [{
                        label: 'Performance %',
                        data: [{{ (float) $currentPerformance }}],
                        backgroundColor: '#3f7cf7'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: 100
                        }
                    }
                }
            });

            window.__monthlyPerfChart = new Chart(monthlyCtx, {
                type: 'line',
                data: {
                    labels: @json($monthlyLabels),
                    datasets: [{
                        label: 'Performance %',
                        data: @json($monthlyPerformances),
                        borderColor: '#2a9d8f',
                        backgroundColor: 'rgba(42,157,143,0.2)',
                        fill: true,
                        tension: 0.25
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: 100
                        }
                    }
                }
            });

            window.__monthlyIncomeChart = new Chart(incomeCtx, {
                type: 'line',
                data: {
                    labels: @json($incomeLabels),
                    datasets: [{
                        label: 'Income',
                        data: @json($incomeValues),
                        borderColor: '#f59f00',
                        backgroundColor: 'rgba(245,159,0,0.2)',
                        fill: true,
                        tension: 0.25
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</div>
