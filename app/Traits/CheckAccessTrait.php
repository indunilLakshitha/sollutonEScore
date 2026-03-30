<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait CheckAccessTrait
{
    /**
     * check logged user is the refferal owner
     */
    public function isReferralOwner(string $id)
    {
        $user = User::where('id', $id)
            ->first();

        if (!isset($user)) {
            abort(404);
        }

        if ($user->referrer_id != Auth::user()->reg_no) {
            abort(403);
        }

        return;
    }
}
