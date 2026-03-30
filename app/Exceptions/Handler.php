<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function report(Throwable $exception)
    {
        // Call the default report method first
        parent::report($exception);

        // Send to Discord
        try {
            $webhookUrl = trim(env('DISCORD_WEBHOOK_URL'));

            if (!empty($webhookUrl)) {
                $message = ":x: Exception occurred!\n";
                $message .= "Message: " . $exception->getMessage() . "\n";
                $message .= "File: " . $exception->getFile() . "\n";
                $message .= "Line: " . $exception->getLine() . "\n";

                Http::post($webhookUrl, [
                    'content' => $message,
                ]);
            }
        } catch (\Throwable $e) {
            // Prevent infinite loop if Discord fails
            Log::error("Failed to send error to Discord: " . $e->getMessage());
        }
    }
}
