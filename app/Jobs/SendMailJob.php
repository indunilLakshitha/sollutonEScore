<?php

namespace App\Jobs;

use App\Mail\SendOrderStatusEmail;
use App\Mail\SendRegistrationSuccesEmail;
use App\Mail\SendUserApprovedByAdminEmail;
use App\Mail\UserApprovedByAdmin;
use App\Models\MailDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;
    /**
     * Create a new job instance.
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        if ($this->details['type'] == MailDetail::MAIL_TYPE['REG_SUCCESS']) {

            $email = new SendRegistrationSuccesEmail($this->details);
            Mail::to($this->details['email'])->send($email);
        }

        if ($this->details['type'] == MailDetail::MAIL_TYPE['ADMIN_APPROVED']) {

            $email = new SendUserApprovedByAdminEmail($this->details);
            Mail::to($this->details['email'])->send($email);
        }

        if ($this->details['type'] == MailDetail::MAIL_TYPE['ORDER_STATUS_CHANGED']) {

            $email = new SendOrderStatusEmail($this->details);
            Mail::to($this->details['email'])->send($email);
        }
    }
}
