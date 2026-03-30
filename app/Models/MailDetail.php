<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailDetail extends Model
{
    use HasFactory;

    const MAIL_TYPE = [
        'REG_SUCCESS' => 'REG_SUCCESS',
        'ADMIN_APPROVED' => 'ADMIN_APPROVED',
        'REFERREL_APPROVED' => 'REFERREL_APPROVED',
        'ORDER_STATUS_CHANGED' => 'ORDER_STATUS_CHANGED',
        'WITHDRAWED' => 'WITHDRAWED'
    ];
}
