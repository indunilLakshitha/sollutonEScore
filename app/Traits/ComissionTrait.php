<?php

namespace App\Traits;

use App\Models\Comission;
use App\Models\ComissionHistory;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait ComissionTrait
{
    use WalletTrait;

    public function setComissionHistory(
        string $userId,
        int $leftPoints = 0,
        int $rightPoints = 0,
        string $from = null,
    ): ComissionHistory {

        $type = ComissionHistory::TYPE['REMOVED'];
        if (isset($from)) {
            $type = ComissionHistory::TYPE['ADDED'];
        }

        return ComissionHistory::create([
            'user_id' => $userId,
            'from_user_id' => $from,
            'left_points' => $leftPoints,
            'right_points' => $rightPoints,
            'type' => $type
        ]);
    }

    public function addDirectComission(string $userId, string $amount)
    {

        $ref_user = User::find($userId);
        if ($ref_user->er_status != User::USER_STATUS['ER']) {
            return;
        }

        $wallet = Wallet::where('user_id', $userId)->first();
        if (!isset($wallet)) {
            $wallet = new Wallet();
            $wallet->user_id = $userId;
        }
        $wallet->balance += $amount;
        $wallet->save();

        $this->setWalletHistory(
            userId: $userId,
            wallet: $wallet,
            amount: $amount,
            type: WalletHistory::TYPE['ADDED'],
            comissionType: WalletHistory::COMISSION_TYPES['DIRECT']
        );

        Log::debug('addDirectComission : ' . $userId . ' ' .   $amount);
    }

    public function transferDummyCommissions()
    {
        $dummies = Wallet::join('users', 'users.id', 'wallets.user_id')
            ->where('users.type', '!=', User::USER_TYPE['MAIN'])
            ->where('wallets.balance', '>', 0)
            ->select('users.parent_id', 'users.id', 'wallets.user_id', 'wallets.balance', 'users.type')
            ->get();

        $dummyIdList = [];

        foreach ($dummies as $dummy) {
            $wallet = Wallet::where('user_id', $dummy->parent_id)
                ->first();

            if (!isset($wallet)) {
                $wallet = new Wallet();
                $wallet->user_id = $dummy->parent_id;
                $wallet->balance = 0;
                $wallet->save();
            }


            $walletBalance =  (int)$wallet->balance;
            $wallet->balance =  (int)$wallet->balance +  (int)$dummy->balance;

            $wallet->save();

            // Log::alert(' ID : [' .  $wallet->id   . '] USER ID : ' . $wallet->user_id . ' BALANCE : ' . $wallet->balance);


            $this->setWalletHistoryByWalletId(
                userId: $dummy->parent_id,
                walletId: $wallet->id,
                walletBalance: $walletBalance,
                amount: $dummy->balance,
                type: WalletHistory::TYPE['ADDED'],
                comissionType: WalletHistory::COMISSION_TYPES['DUMMY_TRANSFERED']
            );

            array_push($dummyIdList, $dummy->user_id);
        }

        Wallet::whereIn('user_id', $dummyIdList)->update(['balance' => 0]);
    }
}
