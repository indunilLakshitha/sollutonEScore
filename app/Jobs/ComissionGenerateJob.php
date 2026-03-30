<?php

namespace App\Jobs;

use App\Models\MasterSetting;
use App\Models\User;
use App\Usecases\Comission\ComissionGenerateUsecase;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ComissionGenerateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $userId;
    /**
     * Create a new job instance.
     */
    public function __construct($userId = null)
    {
        $this->userId = $userId;
        if (!isset($userId)) {
            $this->userId = 333;
        }
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        (new ComissionGenerateUsecase())->handle(userId: $this->userId);
    }
}
