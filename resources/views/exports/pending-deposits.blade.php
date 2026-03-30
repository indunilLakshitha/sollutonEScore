<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Pending Deposit Requests</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 12px;
            color: #111;
        }

        .mb-1 {
            margin-bottom: 4px;
        }

        .summary {
            margin-bottom: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #bbb;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        .text-end {
            text-align: right;
        }
    </style>
</head>

<body>
    <h2 class="mb-1">Pending Deposit Requests</h2>
    <div class="summary">
        <div>Status: <strong>{{ $filters['status'] }}</strong></div>
        <div>From: <strong>{{ $filters['from'] ?: 'Any' }}</strong></div>
        <div>To: <strong>{{ $filters['to'] ?: 'Any' }}</strong></div>
        <div>Generated At: <strong>{{ now()->format('Y-m-d H:i') }}</strong></div>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Mobile No</th>
                <th>Requested Amount</th>
                <th>Balance</th>
                <th>Requested At</th>
                <th>Bank Details</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pendings as $pending)
                <tr>
                    <td>{{ $pending->id }}</td>
                    <td>{{ $pending->user?->name }}</td>
                    <td>{{ $pending->user?->mobile_no }}</td>
                    <td class="text-end">{{ $currency }}{{ number_format($pending->amount, 2) }}</td>
                    <td class="text-end">{{ $currency }}{{ number_format($pending->wallet?->balance, 2) }}</td>
                    <td>
                        @if ($pending->requested_at)
                            {{ \Carbon\Carbon::parse($pending->requested_at)->format('Y-m-d H:i') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        {{ $pending->user?->bank?->holder_name }} /
                        {{ $pending->user?->bank?->account_number }} /
                        {{ $pending->user?->bank?->bank_name }} /
                        {{ $pending->user?->bank?->branch }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No records match the selected filters.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>

