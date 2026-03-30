<?php

namespace App\Console\Commands;

use App\Models\Task;
use App\Models\User;
use App\Services\TaskNotificationMessenger;
use Illuminate\Console\Command;

class SendTaskDeadlineNotifications extends Command
{
    protected $signature = 'tasks:send-deadline-notifications';

    protected $description = 'Send task reminder (2 days before) and deadline alert (within 24 hours) via SMS and email';

    public function handle(TaskNotificationMessenger $messenger): int
    {
        $reminders = 0;
        $alerts = 0;

        Task::query()
            ->whereIn('status', [Task::STATUS_ASSIGNED, Task::STATUS_SUBMITTED])
            ->whereNotNull('deadline_at')
            ->whereNotNull('assigned_user_id')
            ->where('deadline_at', '>', now())
            ->chunkById(100, function ($tasks) use ($messenger, &$reminders, &$alerts) {
                foreach ($tasks as $task) {
                    $deadline = $task->deadline_at;
                    $user = User::query()->whereKey($task->assigned_user_id)->first(['id', 'name', 'first_name', 'email', 'mobile_no']);
                    if (!$user) {
                        continue;
                    }

                    $reminderDay = $deadline->copy()->startOfDay()->subDays(2);
                    if ($task->pre_deadline_reminder_sent_at === null
                        && now()->startOfDay()->equalTo($reminderDay)) {
                        $msg = sprintf(
                            'Hello %s, reminder: your task "%s" is due on %s. Please complete it in My Tasks.',
                            $user->notificationFirstName(),
                            (string) $task->name,
                            $deadline->format('Y-m-d H:i')
                        );
                        $messenger->notify($user, 'Task reminder: '.$task->name, $msg);
                        $task->pre_deadline_reminder_sent_at = now();
                        $task->save();
                        $reminders++;

                        continue;
                    }

                    $hoursLeft = (int) now()->diffInHours($deadline, false);
                    if ($task->deadline_imminent_alert_sent_at === null
                        && $hoursLeft >= 0
                        && $hoursLeft <= 24) {
                        $msg = sprintf(
                            'Hello %s, deadline soon: your task "%s" is due on %s (within 24 hours).',
                            $user->notificationFirstName(),
                            (string) $task->name,
                            $deadline->format('Y-m-d H:i')
                        );
                        $messenger->notify($user, 'Deadline alert: '.$task->name, $msg);
                        $task->deadline_imminent_alert_sent_at = now();
                        $task->save();
                        $alerts++;
                    }
                }
            });

        $this->info("Reminders: {$reminders}, deadline alerts: {$alerts}");

        return self::SUCCESS;
    }
}
