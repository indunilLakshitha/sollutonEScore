<div>
    <livewire:comp.breadcumb title="SUMMARY" section="User" sub="Monthly Summary" action="All">
        <div class="edash-content-section row g-3 g-md-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
                        <div>
                            <h4 class="card-title mb-0">Monthly Summary</h4>
                            <div class="text-muted small">{{ $user->name }}</div>
                        </div>
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <input type="number" class="form-control" style="width: 120px" min="2000" max="2100"
                                wire:model.live="year" />
                        </div>
                    </div>

                    <div class="card-table table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Performance (%)</th>
                                    <th>Full Amount</th>
                                    <th>Actual Amount</th>
                                    <th>Task Completion</th>
                                    <th>Pending</th>
                                    <th>Expired</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($months as $row)
                                    <tr>
                                        <td class="fw-semibold">{{ $row['label'] }}</td>
                                        <td>{{ number_format((float) $row['performance'], 2) }}%</td>
                                        <td>{{ number_format((float) $row['full_income'], 2) }}</td>
                                        <td>{{ number_format((float) $row['actual_income'], 2) }}</td>
                                        <td style="min-width: 240px">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="small text-muted">
                                                    {{ $row['completed_tasks'] }}/{{ $row['total_tasks'] }}
                                                    ({{ number_format((float) $row['task_completion_rate'], 2) }}%)
                                                </span>
                                                <span class="small text-muted">Pending: {{ $row['pending_tasks'] }}</span>
                                            </div>
                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                    style="width: {{ (int) $row['progress_percent'] }}%;"
                                                    aria-valuenow="{{ (int) $row['progress_percent'] }}" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td>{{ (int) $row['pending_tasks'] }}</td>
                                        <td>{{ (int) $row['expired_tasks'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </livewire:comp.breadcumb>
</div>

