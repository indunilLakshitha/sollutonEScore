<!--! ================================================================ !-->
<!--! Start:: Page Content !-->
<!--! ================================================================ !-->
<div id="dashboard-performance">
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

    <div class="row g-3 g-md-4 mb-4">
        <div class="col-md-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-muted small">Current month approved score</div>
                    <div class="h4 mb-0">{{ number_format((float) $currentApprovedTotal, 2) }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-muted small">Current month assigned score</div>
                    <div class="h4 mb-0">{{ number_format((float) $currentAssignedTotal, 2) }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-muted small">Current month performance (%)</div>
                    <div class="h4 mb-0">{{ number_format($currentPerformance, 2) }}%</div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-muted small">Current month actual income</div>
                    <div class="h4 mb-0">{{ number_format((float) $currentActualIncome, 2) }}</div>
                </div>
            </div>
        </div>
    </div>

    @if ((float) $currentFullIncome > 0 || (float) $currentActualIncome > 0)
        <div class="row g-3 g-md-4 mb-4">
            <div class="col-12">
                <div class="card h-100">
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
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Current Month Performance</h5>
                </div>
                <div class="card-body">
                    <canvas id="currentPerformanceChart" height="140"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="card-title mb-0">Performance Summary</h5>
                </div>
                <div class="card-body">
                    <canvas id="monthlyPerformanceChart" height="140"></canvas>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card h-100">
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
