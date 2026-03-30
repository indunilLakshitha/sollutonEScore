<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserBankDetail;
use App\Traits\UniqueIdTrait;


class UserBankService
{
    use UniqueIdTrait;

    /**
     * CREATE BANK DATA FOR A USER
     */
    public function addBankToUser(
        string $account_number,
        string $holder_name,
        string $branch,
        string $bank_name,
        string $user_id,
    ): UserBankDetail {

        return UserBankDetail::create([
            'account_number' => $account_number,
            'holder_name' => $holder_name,
            'branch' => $branch,
            'bank_name' => $bank_name,
            'user_id' => $user_id,
            'status' => UserBankDetail::ACTIVE
        ]);
    }
}
