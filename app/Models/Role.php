<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    public const SLUG_DIRECTOR = 'director';

    public const SLUG_MANAGEMENT = 'management';

    public const SLUG_LEADER = 'leader';

    public const SLUG_REPRESENTATIVE = 'representative';

    public const SLUG_ADMIN = 'admin';

    protected $fillable = [
        'name',
        'slug',
        'sort_order',
        'full_access',
    ];

    protected $casts = [
        'full_access' => 'boolean',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function isFullAccess(): bool
    {
        return $this->full_access === true;
    }
}
