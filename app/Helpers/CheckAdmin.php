<?php


namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public static function check(string $userId = null): bool
    {
        if (isset($userId)) {
            $u =  User::where('id', $userId)->select('id', 'is_admin')->first();
            if (!isset($u))
                return false;
            return $u->is_admin;
        }
        return Auth::user()->is_admin;
    }
}
