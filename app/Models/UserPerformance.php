<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPerformance extends Model
{
    protected $fillable = [
        'user_id',
        'year',
        'month',
        'approved_score_total',
        'assigned_score_total',
        'performance',
    ];

    protected $casts = [
        'year' => 'integer',
        'month' => 'integer',
        'approved_score_total' => 'integer',
        'assigned_score_total' => 'integer',
        'performance' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
