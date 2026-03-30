<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserMonthlySalary extends Model
{
    protected $fillable = [
        'user_id',
        'year',
        'month',
        'amount',
        'sales_count',
    ];

    protected $casts = [
        'year' => 'integer',
        'month' => 'integer',
        'amount' => 'decimal:2',
        'sales_count' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
