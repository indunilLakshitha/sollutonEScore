<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    use HasFactory;

    const STATUS = [
        'SEND_MSG_SUCCESS' => 1001,
        'OTP_VERIFIED' => 1000,
    ];
}
