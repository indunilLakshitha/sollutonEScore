<?php

namespace App\Jobs;

use App\Models\DeletedUser;
use App\Models\User;
use App\Traits\ActivityLogTrait;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteRequestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, ActivityLogTrait;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 600; // 10 minutes

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $date = Carbon::now()->subDays(30);

        $this->addToLog(msg: 'Delete Old Requests Before ' . $date . ' STARTED');

        $count = 0;

        // Process users in chunks to avoid memory issues and improve performance
        User::where('approved_by_referrer', false)
            ->where('approved_by_admin', false)
            ->whereNull('path')
            ->where('type', User::USER_TYPE['MAIN'])
            ->whereDate('created_at', '<', $date)
            ->chunk(100, function ($users) use (&$count) {
                foreach ($users as $user) {
                    /**
                     * keep deleted user data
                     */
                    $deleted_user = new DeletedUser();
                    $deleted_user->user_id =  $user->id;
                    $deleted_user->name = $user->first_name . ' ' . $user->last_name;
                    $deleted_user->referrer_id = $user->referrer_id;
                    $deleted_user->registered_at = $user->created_at;
                    $deleted_user->mobile_no = $user->mobile_no;
                    $deleted_user->save();

                    // Delete related users first
                    User::where('parent_id', $user->id)->forceDelete();
                    $user->forceDelete();

                    $count++;
                }
            });

        $text = 'Delete Old Requests Before ' . $date . ' ' .    (string) $count . ' DELETED';
        $this->addToLog(msg: $text);

    }
}
