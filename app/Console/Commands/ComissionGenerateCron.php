<?php

namespace App\Console\Commands;

use App\Jobs\ComissionGenerateJob;
use App\Models\MasterSetting;
use App\Traits\ActivityLogTrait;
use Illuminate\Console\Command;

class ComissionGenerateCron extends Command
{
    use ActivityLogTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'comission:gen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will run Comission Generate Queue';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (MasterSetting::first()->commission_enabled == 1) {
            $this->addToLog(msg: 'Comission Generate SCHECDULE : JOB : STARTED');
            dispatch((new ComissionGenerateJob()));
            $this->addToLog(msg: 'Comission Generate SCHECDULE : JOB : ENDED');
        }
    }
}
