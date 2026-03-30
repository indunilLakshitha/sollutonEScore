<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Traits\DiscordMsgTrait;
use App\Usecases\Ranking\RankingUsecase;
use Illuminate\Console\Command;

class RankingCron extends Command
{
    use DiscordMsgTrait;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ranking:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update rankings for all users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting ranking update for all users...');

        $this->sendDiscordMsg(msg: 'Starting ranking update for all users...');
        // Process users in chunks to avoid memory issues
        $totalUsers = User::where('er_status', 4)->count();
        $this->info("Processing " . $totalUsers . " users...");
        $this->sendDiscordMsg(msg: "Processing " . $totalUsers . " users...");
        $processed = 0;
        $errors = 0;

        // Create an instance of the RankingUsecase
        $rankingUsecase = new RankingUsecase();

        $progressBar = $this->output->createProgressBar($totalUsers);
        $progressBar->start();

        User::where('er_status', 4)->chunk(100, function ($users) use (&$processed, &$errors, $rankingUsecase, $progressBar) {
            foreach ($users as $user) {
                try {
                    // Call the handle function for each user
                    $rankingUsecase->handle($user->id);
                    $processed++;
                    $progressBar->advance();
                } catch (\Exception $e) {
                    $errors++;
                    $this->error("Error processing user ID {$user->id}: " . $e->getMessage());
                    $this->sendDiscordMsg(msg: "Error processing user ID {$user->id}: " . $e->getMessage());
                }
            }

            // Clear any cached models to free memory
            gc_collect_cycles();
        });

        $progressBar->finish();
        $this->info("\nRanking update completed!");
        $this->sendDiscordMsg(msg: "\nRanking update completed!");
        $this->info("Processed: " . $processed . " users");

        $this->info("Errors: " . $errors . " users");
    }
}
