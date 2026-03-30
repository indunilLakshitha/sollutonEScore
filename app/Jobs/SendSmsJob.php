<?php

namespace App\Jobs;

use App\Models\MailDetail;
use App\Models\MasterSetting;
use App\Services\SmsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendSmsJob implements ShouldQueue
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
            if (MasterSetting::first()->reg_success_sms_enabled == 1) {

                (new SmsService())->sendMsg(mobileNo: $this->details['mobileNo'], msg: $this->details['msg']);
            }
        }
        if ($this->details['type'] == MailDetail::MAIL_TYPE['ADMIN_APPROVED']) {
            if (MasterSetting::first()->approved_sms_enabled == 1) {
                (new SmsService())->sendMsg(mobileNo: $this->details['mobileNo'], msg: $this->details['msg']);
            }
        }
        if ($this->details['type'] == MailDetail::MAIL_TYPE['WITHDRAWED']) {
            (new SmsService())->sendMsg(mobileNo: $this->details['mobileNo'], msg: $this->details['msg']);
        }
        
        if ($this->details['type'] == MailDetail::MAIL_TYPE['ORDER_STATUS_CHANGED']) {
            (new SmsService())->sendMsg(mobileNo: $this->details['mobileNo'], msg: $this->details['msg']);
        }
    }
}
