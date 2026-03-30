<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendOtpSmsDetail extends Model
{
    use HasFactory;

    protected $fillable = ['ref', 'user_id'];
}
