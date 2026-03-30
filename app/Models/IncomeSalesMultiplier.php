<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeSalesMultiplier extends Model
{
    use HasFactory;

    protected $table = 'income_sales_multipliers';

    protected $fillable = [
        'management_multiplier',
        'director_multiplier',
    ];

    public $timestamps = true;
}

