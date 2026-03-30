<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [

        Commands\ComissionGenerateCron::class,
        Commands\RankingCron::class,

    ];
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        $schedule->command('comission:gen')
            ->dailyAt('12:01');

        $schedule->command('app:delete-late-requests')
            ->dailyAt('12:01');

        $schedule->command('ranking:update')
            ->dailyAt('01:00');

        $schedule->command('tasks:send-deadline-notifications')
            ->dailyAt('08:00');

        $schedule->command('tasks:send-monthly-summary')
            ->monthlyOn(1, '7:00');

        // Run every 6 hours
        // $schedule->command('backup:run --only-db')->cron('0 */6 * * *');


    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
