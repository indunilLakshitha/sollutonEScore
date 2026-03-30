<?php

namespace App\Traits;

use App\Models\User;

trait CustomerApproveTrait
{
    public function getErStatusLabel($status)
    {
        return User::USER_STATUS_LABLE[$status];
    }

    public function getUserTypeLabel($type)
    {
        return User::USER_TYPE_LABLE[$type];
    }
}
