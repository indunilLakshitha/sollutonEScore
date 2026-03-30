<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyMonthlySale extends Model
{
    protected $fillable = [
        'year',
        'month',
        'sales_count',
    ];

    protected $casts = [
        'year' => 'integer',
        'month' => 'integer',
        'sales_count' => 'integer',
    ];
}
