<?php

namespace App\Traits;

use App\Jobs\SendSmsJob;
use App\Models\MailDetail;
use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait WalletTrait
{
    use SMSTrait;

    public function setWalletHistory(
        string $userId,
        Wallet $wallet,
        int $amount,
        string $type,
        string $comissionType
    ): WalletHistory {
        return WalletHistory::create([
            'user_id' => $userId,
            'wallet_id' => $wallet->id,
            'amount' => $amount,
            'balance' => $wallet->balance,
            'type' => $type,
            'comission_type' => $comissionType,
        ]);
    }

    public function setWalletHistoryByWalletId(
        string $userId,
        string $walletId,
        string $walletBalance,
        int $amount,
        string $type,
        string $comissionType
    ): WalletHistory {
        return WalletHistory::create([
            'user_id' => $userId,
            'wallet_id' => $walletId,
            'amount' => $amount,
            'balance' => $walletBalance,
            'type' => $type,
            'comission_type' => $comissionType,
        ]);
    }

    public function setWalletHistoryWhenRequest(
        string $userId,
        Wallet $wallet,
        int $amount,
        string $type
    ): WalletHistory {
        return WalletHistory::create([
            'user_id' => $userId,
            'wallet_id' => $wallet->id,
            'amount' => $amount,
            'balance' => $wallet->balance,
            'type' => $type,
            'requested_at' => Carbon::now(),
            'status' => WalletHistory::STATUS['REQUESTED'],
            'requested_by' => Auth::user()->id,

        ]);
    }

    public function setToPaid(string $walletHistoryId)
    {
        $request = WalletHistory::where('id', $walletHistoryId)->first();
        if (!isset($request))
            return $this->dispatch('failed_alert', ['title' => 'Invalid Request']);

        $request->status = WalletHistory::STATUS['TRANSFERED'];
        $request->paid_by = Auth::user()->id;
        $request->paid_at = Carbon::now();
        $request->save();

        $user = User::find($request->user_id);
        $details['mobileNo'] = $user->mobile_no;
        $details['fee'] = $request->amount;
        $details['type'] = MailDetail::MAIL_TYPE['WITHDRAWED'];

        $details['msg'] = $this->getWithdrawedSms(
            amount: $details['fee'],
            firstName: $user->notificationFirstName()
        );
        dispatch(new SendSmsJob($details));

        return;
    }

    public function setToCansel(string $walletHistoryId)
    {
        $request = WalletHistory::where('id', $walletHistoryId)->first();
        if (!isset($request))
            return $this->dispatch('failed_alert', ['title' => 'Invalid Request']);

        $request->status = WalletHistory::STATUS['CANSELED'];
        $request->paid_by = Auth::user()->id;
        $request->paid_at = Carbon::now();
        $request->save();

        $this->addToWallet(walletId: $request->wallet_id, amount: $request->amount);

        return;
    }

    public function addToWallet(string $walletId, string $amount)
    {
        $wallet = Wallet::find($walletId);
        $wallet->balance += $amount;

        $wallet->save();

        $this->mount();
        $this->dispatch('success_alert', ['title' => 'Wallet Updated']);
    }

    public function getWallet(string $userId)
    {
        return Wallet::where('user_id', $userId)->first();
    }

    public function deductFromWallet(string $amount)
    {
        $wallet = Wallet::where('user_id', Auth::user()->id)->first();
        $wallet->balance -= $amount;
        $wallet->save();

        return $wallet;
    }

    public function addToWalletHistory(
        Wallet $wallet,
        string $amount,
        string $type,
    ) {
        return WalletHistory::create([
            'user_id' => Auth::user()->id,
            'wallet_id' => $wallet->id,
            'amount' => $amount,
            'balance' => $wallet->balance,
            'type' => $type,
            'requested_at' => Carbon::now(),
            'status' => WalletHistory::STATUS['TRANSFERED'],
            'comission_type' => WalletHistory::COMISSION_TYPES['MARKETPLACE_PURCHASE'],
            'requested_by' => Auth::user()->id,

        ]);
    }
}
