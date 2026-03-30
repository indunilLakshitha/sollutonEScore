<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserBenificiaryDetail;
use App\Traits\PathTrait;
use App\Traits\UniqueIdTrait;
use Carbon\Carbon;

class UserService
{
    use UniqueIdTrait, PathTrait;

    /**
     * CREATE LEFT SIDE USER ACCOUNT
     */
    public function addLeftAccount(User $user, string $status = null, string $paymentStatus = null): User
    {
        $leftUser = User::create([
            'name' => $user->name . ' - ' . User::LEFT,
            'email' => $user->email,
            'password' => $user->password,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
        ]);

        $leftUser->unique_id = $this->getUniqueIdForLeftUser(id: $leftUser->id);
        if (isset($status))
            $leftUser->er_status = $status;
        else
            $leftUser->er_status = User::NONE;

        if (isset($paymentStatus))
            $leftUser->payment_status = $paymentStatus;

        $leftUser->type = User::LEFT;
        $leftUser->parent_id = $user->id;
        $leftUser->parent_unique_id = $user->unique_id;
        $leftUser->assigned_user_side = User::USER_TYPE['LEFT'];
        $leftUser->save();
        $leftUser->reg_no = $this->getCustomId(id: $leftUser->id);
        $leftUser->save();



        return $leftUser;
    }

    /**
     * CREATE RIGHT SIDE USER ACCOUNT
     */
    public function addRightAccount(User $user, string $status = null, string $paymentStatus = null): User
    {
        $rightUser = User::create([
            'name' => $user->name . ' - ' . User::RIGHT,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'password' => $user->password,
        ]);

        $rightUser->unique_id = $this->getUniqueIdForRightUser(id: $rightUser->id);
        $rightUser->type = User::RIGHT;

        if (isset($status))
            $rightUser->er_status = $status;
        else
            $rightUser->er_status = User::NONE;

        if (isset($paymentStatus))
            $rightUser->payment_status = $paymentStatus;
        $rightUser->parent_id = $user->id;
        $rightUser->parent_unique_id = $user->unique_id;
        $rightUser->assigned_user_side = User::USER_TYPE['RIGHT'];
        $rightUser->save();
        $rightUser->reg_no = $this->getCustomId(id: $rightUser->id);

        $rightUser->save();

        return $rightUser;
    }

    public function updateLeftAccount(User $user, User $parent, string $status = null, string $paymentStatus = null, Carbon $time): User
    {
        $leftUser = $user;
        if (isset($status))
            $leftUser->er_status = $status;
        else
            $leftUser->er_status = User::NONE;

        if (isset($paymentStatus))
            $leftUser->payment_status = $paymentStatus;

        $leftUser->approved_by_admin = true;
        $leftUser->approved_by_referrer = true;
        $leftUser->approved_at = $time;
        $leftUser->path = $this->getMyPath(parentPath: $parent->path, myUniqueId: $leftUser->unique_id, parentSide: 'SL');
        $leftUser->save();

        return $leftUser;
    }

    /**
     * CREATE RIGHT SIDE USER ACCOUNT
     */
    public function updateRightAccount(User $user, User $parent, string $status = null, string $paymentStatus = null, Carbon $time): User
    {
        $rightUser =  $user;


        if (isset($status))
            $rightUser->er_status = $status;
        else
            $rightUser->er_status = User::NONE;

        if (isset($paymentStatus))
            $rightUser->payment_status = $paymentStatus;

        $rightUser->approved_by_admin = true;
        $rightUser->approved_at = $time;
        $rightUser->approved_by_referrer = true;
        $rightUser->path = $this->getMyPath(parentPath: $parent->path, myUniqueId: $rightUser->unique_id, parentSide: 'SR');
        $rightUser->save();


        return $rightUser;
    }

    /**
     * CREATE BENEFICIARY DATA FOR A USER
     */
    public function addBenificiearyToUser(
        string $name,
        string $relationship,
        string $contact_no,
        string $user_id,
    ): UserBenificiaryDetail {

        return UserBenificiaryDetail::create([
            'name' => $name,
            'relationship' => $relationship,
            'contact_no' => $contact_no,
            'user_id' => $user_id
        ]);
    }
}
