<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserMonthlyBonus extends Model
{
    public const TYPE_CASH = 'cash';

    public const TYPE_GIFT = 'gift';

    protected $fillable = [
        'user_id',
        'year',
        'month',
        'bonus_type',
        'cash_amount',
        'gift_name',
        'claimed_at',
    ];

    protected $casts = [
        'year' => 'integer',
        'month' => 'integer',
        'cash_amount' => 'decimal:2',
        'claimed_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
