<?php

namespace App\Traits;

use App\Models\Criteria;
use App\Models\User;

trait CriteriaTrait
{
    /**
     * Get active criteria for a specific user
     *
     * @param User|int $user User instance or user ID
     * @return Collection
     */
    public function getActiveCriteriaForUser($userId)
    {
        return Criteria::where('status', true)
            ->orderBy('count', 'asc')
            ->get();
    }

    /**
     * Get criteria by count
     *
     * @param int $count
     * @return Criteria|null
     */
    public function getCriteriaByCount($count)
    {
        return Criteria::where('status', true)
            ->where('count', $count)
            ->first();
    }

    /**
     * Get all active criteria
     *
     * @return Collection
     */
    public function getAllActiveCriteria()
    {
        return Criteria::where('status', true)
            ->orderBy('count', 'asc')
            ->get();
    }
}
