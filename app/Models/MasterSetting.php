<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterSetting extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'commission_enabled',
        'reg_success_mail_enabled',
        'reg_success_sms_enabled',
        'approved_mail_enabled',
        'approved_sms_enabled',
    ];
}
