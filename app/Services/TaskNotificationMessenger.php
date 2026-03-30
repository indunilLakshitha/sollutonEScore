<?php

namespace App\Services;

use App\Mail\PlainTextNotificationMail;
use App\Models\Task;
use App\Models\User;
use App\Services\SmsService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class TaskNotificationMessenger
{
    /**
     * SMS is sent immediately; email is pushed to the queue (see sendEmail).
     */
    public function notify(User $user, string $emailSubject, string $messageBody): void
    {
        $this->sendSms($user, $messageBody);
        $this->sendEmail($user, $emailSubject, $messageBody);
    }

    /**
     * Full detail in email (queued); SMS kept short for provider limits (sent immediately).
     */
    public function notifyWithShortSms(User $user, string $emailSubject, string $emailBody, string $smsBody): void
    {
        $this->sendSms($user, $smsBody);
        $this->sendEmail($user, $emailSubject, $emailBody);
    }

    public function assignmentMessage(User $user, Task $task): string
    {
        $deadline = $task->deadline_at
            ? $task->deadline_at->format('Y-m-d H:i')
            : 'No deadline';

        return sprintf(
            'Hello %s, a new task has been assigned to you: %s. Deadline: %s.',
            $user->notificationFirstName(),
            (string) $task->name,
            $deadline
        );
    }

    public function taskStatusMessage(User $user, Task $task, string $statusWord): string
    {
        return sprintf(
            'Hello %s, your task "%s" has been %s.',
            $user->notificationFirstName(),
            (string) $task->name,
            $statusWord
        );
    }

    private function sendSms(User $user, string $messageBody): void
    {
        $mobileNo = trim((string) ($user->mobile_no ?? ''));
        if ($mobileNo === '') {
            Log::info('Task notification SMS skipped (no mobile_no on user).', [
                'user_id' => (int) $user->id,
            ]);

            return;
        }

        try {
            $ok = app(SmsService::class)->sendMsg($mobileNo, Str::limit($messageBody, 480));
            if (! $ok) {
                Log::warning('Task notification SMS was not accepted by the provider.', [
                    'user_id' => (int) $user->id,
                ]);
            }
        } catch (\Throwable $e) {
            Log::warning('Task notification SMS failed.', [
                'user_id' => (int) $user->id,
                'error' => $e->getMessage(),
            ]);
        }
    }

    private function sendEmail(User $user, string $subject, string $bodyText): void
    {
        $email = trim((string) ($user->email ?? ''));
        if ($email === '') {
            return;
        }

        try {
            Mail::to($email)->queue(new PlainTextNotificationMail($subject, $bodyText));
        } catch (\Throwable $e) {
            Log::warning('Task notification email queue failed.', [
                'user_id' => (int) $user->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
