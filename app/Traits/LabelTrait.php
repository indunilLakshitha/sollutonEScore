<?php

namespace App\Traits;

use App\Models\User;

trait LabelTrait
{
    public function getErStatusLabel($status)
    {
        $key = (string) ($status ?? '');
        return User::USER_STATUS_LABLE[$key] ?? 'UNKNOWN';
    }

    public function getUserTypeLabel($type)
    {
        $key = (string) ($type ?? '');
        return User::USER_TYPE_LABLE[$key] ?? 'UNKNOWN';
    }
}
