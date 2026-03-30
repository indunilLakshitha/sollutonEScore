<?php

namespace App\Livewire\Profile;

use App\Models\BillingAddress;
use App\Models\Branch;
use App\Models\User;
use App\Models\UserBankDetail;
use App\Models\UserBenificiaryDetail;
use App\Models\Wallet;
use App\Models\WalletHistory;
use App\Rules\MobileNoalidation;
use App\Rules\NICValidation;
use App\Services\UserBankService;
use App\Services\UserService;
use App\Traits\LabelTrait;
use App\Traits\UniqueIdTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

use function PHPUnit\Framework\returnValueMap;

class EditProfile extends Component
{
    use UniqueIdTrait, LabelTrait;

    public $mainUser;
    public $name, $first_name, $last_name, $reg_no, $type, $address, $email, $mobile_no, $dob, $nic, $gender, $customer_branch;
    public $bank_name, $branch, $holder_name, $account_number;
    public $benificiary_name, $relationship, $benificiary_contact_no, $account_type;
    public $hasPermission = false; // can edit personal/bank (admin OR self)
    public $isAdmin = false; // admin-only actions like wallet/points
    public $passwordMode = false;
    public $password = '';
    public $confirm_password = '';
    public $basicMode = true;
    public $walletMode = false;
    public $bankEnabled = false;
 
    public $userId;

    public function mount($userId)
    {
        $loggedUser = Auth::user();
        $this->isAdmin = (int) ($loggedUser?->is_admin ?? 0) === 1;
        $this->hasPermission = $this->isAdmin || ((int) ($loggedUser?->id ?? 0) === (int) $userId);
        $this->userId = $userId;
        $user = User::where('users.id', $userId)
            ->first();
        $this->mainUser = $user;

        $this->name = $user->name;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->reg_no = $user->reg_no;
        $this->type = $user->type;
        $this->address = $user->address;
        $this->email = $user->email;
        $this->mobile_no = $user->mobile_no;
        $this->gender = $user->gender;
        $this->dob = $user->dob;
        $this->nic = $user->nic;
        $this->customer_branch = $user->customer_branch;

        $this->benificiary_name = $user->benificiary_name;
        $this->relationship = $user->relationship;
        $this->benificiary_contact_no = $user->benificiary_contact_no;
        $this->nic = $user->nic;

        $this->bank_name = $user->bank_name;
        $this->branch = $user->branch;
        $this->holder_name = $user->holder_name;
        $this->account_number = $user->account_number;

        $this->left_points = $user->left_points;
        $this->right_points = $user->right_points;

        if ($user->er_status == 4 && !isset($this->bank_name)) {
            $this->bankEnabled = true;
        }

        if ($loggedUser->is_admin) {
            $this->bankEnabled = true;
        }

        $this->account_type = $this->getUserTypeLabel($user->type);

    }



    public function savePersonal()
    {
        $this->validate([
            'first_name' => 'required|not_regex:/[@#$%^&*();><]/',
            'last_name' => 'required|not_regex:/[@#$%^&*();><]/',
            'reg_no' => 'required|string|max:255|unique:users,reg_no,' . ((int) ($this->mainUser->id ?? 0)),
            'email' => 'required|email',
            'mobile_no' => ['required', 'numeric', new MobileNoalidation],
        ]);

        try {
            if (!$this->hasPermission) {
                return redirect()->route('dashboard');
            }

            DB::beginTransaction();

            $user = $this->mainUser;

            if ($this->hasPermission) {
                $user->name = $this->first_name . ' ' . $this->last_name;
                $user->first_name = $this->first_name;
                $user->last_name = $this->last_name;
                $user->reg_no = $this->reg_no;

                User::where('parent_id', $user->id)->update([
                    'name' => $user->name,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'reg_no' => $user->reg_no,
                ]);

                $user->email = $this->email;
                $user->mobile_no = $this->mobile_no;
                User::where('parent_id', $user->id)->update([
                    'email' => $user->email,
                    'mobile_no' => $user->mobile_no,
                ]);
            }


            $user->save();

            DB::commit();

            $this->mount($user->id);

            return $this->dispatch('success_alert', ['title' => 'Personal Details successfully Updated']);
        } catch (Exception $e) {

            DB::rollBack();
            Log::alert('savePersonal :: ' . $e->getMessage());
        }
    }

    public function saveBank()
    {
        if (!$this->bankEnabled) {
            return redirect()->route('dashboard');
        }

        $this->validate(
            [
                'account_number' => 'required|not_regex:/[@#$%^&*();><]/',
                'bank_name' => 'required|not_regex:/[@#$%^&*();><]/',
                'holder_name' => 'required|not_regex:/[@#$%^&*();><]/',
                'branch' => 'required|not_regex:/[@#$%^&*();><]/'
            ],
        );

        try {
            DB::beginTransaction();
            $user = $this->mainUser;

            if ($this->bankEnabled) {
                if ($this->account_number) {
                    UserBankDetail::where('user_id', $user->id)->delete();
                    (new UserBankService())->addBankToUser(
                        account_number: $this->account_number,
                        bank_name: $this->bank_name,
                        holder_name: $this->holder_name,
                        branch: $this->branch,
                        user_id: $user->id
                    );
                }
            }

            DB::commit();

            $this->mount($user->id);

            return $this->dispatch('success_alert', ['title' => 'Bank Details successfully Updated']);
        } catch (Exception $e) {

            DB::rollBack();
            Log::alert('saveBank :: ' . $e->getMessage());
        }
    }

    public function updatePoints()
    {
        if (!$this->isAdmin) {
            return redirect()->route('dashboard');
        }
        try {
            DB::beginTransaction();
            $user = $this->mainUser;

            if ($this->isAdmin) {
                $user->right_points = $this->right_points;
                $user->left_points = $this->left_points;
                $user->save();
            }

            DB::commit();

            $this->mount($user->id);

            return $this->dispatch('success_alert', ['title' => 'Point Details successfully Updated']);
        } catch (Exception $e) {

            DB::rollBack();
            Log::alert('updatePoints :: ' . $e->getMessage());
        }
    }

    public function saveBenificiary()
    {

        $this->validate(
            [
                'benificiary_contact_no' => ['required', 'not_regex:/[@#$%^&*();><]/', new MobileNoalidation],
                'relationship' => 'required|not_regex:/[@#$%^&*();><]/',
                'benificiary_name' => 'required|not_regex:/[@#$%^&*();><]/',
            ],
        );

        try {
            DB::beginTransaction();
            $user = $this->mainUser;

            UserBenificiaryDetail::where('user_id', $user->id)->delete();
            (new UserService())->addBenificiearyToUser(
                contact_no: $this->benificiary_contact_no ? $this->benificiary_contact_no : '',
                relationship: $this->relationship ? $this->relationship : '',
                name: $this->benificiary_name ? $this->benificiary_name : '',
                user_id: $user->id
            );

            DB::commit();

            $this->mount($user->id);

            return $this->dispatch('success_alert', ['title' => 'Benificiary Details successfully Updated']);
        } catch (Exception $e) {

            DB::rollBack();
            Log::alert('saveBenificiary :: ' . $e->getMessage());
        }
    }
    public function saveBilling()
    {

        $this->validate(
            [
                'billing_first_name' => 'required|not_regex:/[@#$%^&*();><]/',
                'billing_last_name' => 'required|not_regex:/[@#$%^&*();><]/',
                'street_addr' => 'required|not_regex:/[@#$%^&*();><]/',
                'zip' => 'required|not_regex:/[@#$%^&*();><]/',
            ],
        );

        try {
            DB::beginTransaction();
            $user = $this->mainUser;

            BillingAddress::where('user_id', $user->id)->delete();
            $billing = new BillingAddress();
            $billing->user_id = $user->id;
            $billing->zip = $this->zip;
            $billing->street_addr = $this->street_addr;
            $billing->first_name = $this->billing_first_name;
            $billing->last_name = $this->billing_last_name;
            $billing->save();

            DB::commit();

            $this->mount($user->id);

            return $this->dispatch('success_alert', ['title' => 'Billing Details successfully Updated']);
        } catch (Exception $e) {

            DB::rollBack();
            Log::alert('Billing :: ' . $e->getMessage());
        }
    }

    public function clear()
    {
        $this->name = "";
        $this->first_name = "";
        $this->last_name = "";
        $this->reg_no = "";
        $this->type = "";
        $this->address = "";
        $this->email = "";
        $this->mobile_no = "";
        $this->dob = "";
        $this->nic = "";
        $this->bank_name = "";
        $this->branch = "";
        $this->holder_name = "";
        $this->account_number = "";
        $this->benificiary_name = "";
        $this->relationship = "";
        $this->benificiary_contact_no = "";
    }

    public function clearPasswords()
    {
        $this->confirm_password = "";
        $this->password = "";
    }


    public function render()
    {
        return view('livewire.profile.edit-profile');
    }

    public function showPassword()
    {
        $this->basicMode = false;
        $this->walletMode = false;
        $this->passwordMode = true;
    }

    public function showBasic()
    {
        $this->basicMode = true;
        $this->walletMode = false;
        $this->passwordMode = false;
    }

    public function showWallet()
    {
        $this->walletMode = true;
        $this->basicMode = false;
        $this->passwordMode = false;
    }

    public function editPassword()
    {
        $this->validate([
            'password' => 'required|min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required|min:6'
        ]);

        $user = $this->mainUser;
        $user->password =  Hash::make($this->password);
        $user->save();

        $this->clearPasswords();

        return $this->dispatch('success_alert', title: 'Password successfully Updated');
    }

    public function editWallet()
    {
        $this->validate([
            'new_balance' => 'required|numeric|not_regex:/[@#$%^&*();><]/',
            'reason' => 'required|min:6|string'
        ]);

        $wallet = Wallet::where('user_id',   $this->userId)->first();


        if (is_null($wallet) && !$this->hasPermission) return;
        $newBalance = intval($this->new_balance);

        $diff =  (int)$this->new_balance;
        if($this->new_balance > 0){
            $type = WalletHistory::TYPE['ADDED'];
            $walletBalance = (int)$wallet->balance + (int)$this->new_balance;
        }else{
            $type = WalletHistory::TYPE['REMOVED'];
            $walletBalance = (int)$wallet->balance + (int)$this->new_balance;
        }

        WalletHistory::create([
            'user_id' => $this->userId,
            'wallet_id' => $wallet->id,
            'amount' =>     $diff,
            'balance' =>  $walletBalance,
            'type' => $type,
            'requested_at' => Carbon::now(),
            'status' => WalletHistory::STATUS['TRANSFERED'],
            'requested_by' => Auth::user()->id,
            'reason' => $this->reason,
            'comission_type' => WalletHistory::COMISSION_TYPES['ADMIN_CHANGED'],

        ]);



        $wallet->balance =  $walletBalance;
        $wallet->save();

        $this->new_balance = 0;
        $this->reason = "";
        $this->available_balance = $wallet->balance;
        return $this->dispatch('success_alert', ['title' =>  'successfully Updated']);
    }
}
