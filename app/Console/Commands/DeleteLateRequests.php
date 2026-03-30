<?php

namespace App\Console\Commands;

use App\Jobs\DeleteRequestJob;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteLateRequests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-late-requests';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dispatch(new DeleteRequestJob());
    }
}
