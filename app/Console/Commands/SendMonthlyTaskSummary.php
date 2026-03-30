<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Models\User;
use App\Models\UserPerformance;
use App\Models\UserSalesIncome;
use App\Services\TaskNotificationMessenger;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SendMonthlyTaskSummary extends Command
{
    protected $signature = 'tasks:send-monthly-summary';

    protected $description = 'Send previous month task summary (SMS + email) to members with activity';

    public function handle(TaskNotificationMessenger $messenger): int
    {
        $prev = now()->subMonthNoOverflow();
        $year = (int) $prev->format('Y');
        $month = (int) $prev->format('n');
        $monthName = $prev->format('F Y');

        $userIds = UserPerformance::query()
            ->where('year', $year)
            ->where('month', $month)
            ->pluck('user_id')
            ->merge(
                Task::query()
                    ->whereYear('created_at', $year)
                    ->whereMonth('created_at', $month)
                    ->whereNotNull('assigned_user_id')
                    ->distinct()
                    ->pluck('assigned_user_id')
            )
            ->unique()
            ->filter()
            ->values()
            ->all();

        $sent = 0;

        foreach (array_chunk($userIds, 200) as $chunk) {
            $users = User::query()->whereIn('id', $chunk)->get(['id', 'name', 'first_name', 'email', 'mobile_no']);

            foreach ($users as $user) {
                $perf = UserPerformance::query()
                    ->where('user_id', $user->id)
                    ->where('year', $year)
                    ->where('month', $month)
                    ->first();

                $income = UserSalesIncome::query()
                    ->where('user_id', $user->id)
                    ->where('year', $year)
                    ->where('month', $month)
                    ->first();

                $approvedCount = Task::query()
                    ->where('assigned_user_id', $user->id)
                    ->where('status', Task::STATUS_APPROVED)
                    ->whereYear('approved_at', $year)
                    ->whereMonth('approved_at', $month)
                    ->count();

                $rejectedCount = Task::query()
                    ->where('assigned_user_id', $user->id)
                    ->where('status', Task::STATUS_REJECTED)
                    ->whereYear('rejected_at', $year)
                    ->whereMonth('rejected_at', $month)
                    ->count();

                $performanceStr = $perf ? number_format((float) $perf->performance, 2).'%' : '—';
                $incomeStr = $income ? number_format((float) $income->income_amount, 2) : '—';

                $emailBody = implode("\n", [
                    'Hello '.$user->notificationFirstName().',',
                    '',
                    "Your monthly task summary for {$monthName}:",
                    "Performance: {$performanceStr}",
                    "Sales-based income (saved): {$incomeStr}",
                    "Tasks approved in month: {$approvedCount}",
                    "Tasks rejected in month: {$rejectedCount}",
                    '',
                    'Thank you for your work.',
                ]);

                $sms = "Monthly summary {$monthName}: Perf {$performanceStr}, Income {$incomeStr}. Approved:{$approvedCount} Rejected:{$rejectedCount}.";

                $messenger->notifyWithShortSms(
                    $user,
                    'Monthly task summary — '.$monthName,
                    $emailBody,
                    Str::limit($sms, 400)
                );
                $sent++;
            }
        }

        $this->info("Sent {$sent} monthly summaries for {$monthName}.");

        return self::SUCCESS;
    }
}
