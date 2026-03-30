<?php

namespace App\Livewire\Profile;

use App\Models\User;
use App\Services\UserBankService;
use App\Services\UserService;
use App\Traits\UniqueIdTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CreateProfile extends Component
{
    use UniqueIdTrait;

    public $profile;
    public $name, $first_name, $last_name, $reg_no, $type, $address, $email, $mobile_no, $dob, $nic;
    public $bank_name, $branch, $holder_name, $account_number;
    public $benificiary_name, $relationship, $benificiary_contact_no;
    public $hasPermission = false;

    public function mount()
    {
        $loggedUser = Auth::user();
        $this->hasPermission = $loggedUser->is_admin;
        $this->dob = Carbon::today()->format('y:m:d');
    }

    public function render()
    {
        return view('livewire.profile.create-profile');
    }

    public function saveProfile()
    {
        $this->validate();

        try {

            DB::beginTransaction();
            $user = new User();
            $user->name = $this->name;
            $user->first_name = $this->first_name;
            $user->last_name = $this->last_name;
            $user->reg_no = $this->reg_no;
            // $user->type = $this->type;
            $user->address = $this->address;
            $user->email = $this->email;
            $user->mobile_no = $this->mobile_no;
            $user->dob = $this->dob;
            $user->nic = $this->nic;
            $user->password = Hash::make(env('DEFAULT_PASSWORD'));
            $user->type = User::MAIN;

            $user->save();

            $user->unique_id = $this->getUniqueIdForMainUser(id: $user->id);
            $user->save();

            (new UserService())->addLeftAccount(user: $user);
            (new UserService())->addRightAccount(user: $user);


            (new UserBankService())->addBankToUser(
                account_number: $this->account_number,
                bank_name: $this->bank_name,
                holder_name: $this->holder_name,
                branch: $this->branch,
                user_id: $user->id
            );

            (new UserService())->addBenificiearyToUser(
                contact_no: $this->benificiary_contact_no,
                relationship: $this->relationship,
                name: $this->benificiary_name,
                user_id: $user->id
            );
            DB::commit();
            $this->clear();

            $this->dispatch('success_alert', ['title' => 'User successfully Added']);
            return redirect()->route('admin.customer.index');
        } catch (Exception $e) {

            DB::rollBack();
            Log::alert('saveProfile :: ' . $e->getMessage());
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
        $this->account_number;
        $this->benificiary_name = "";
        $this->relationship = "";
        $this->benificiary_contact_no = "";
    }

    protected function rules()
    {
        return  [
            'name' => 'required',
            'email' => 'email|required',
            'first_name' => 'required',
            'last_name' => 'required',
            'reg_no' => 'required',
            // 'type' => 'required',
            'address' => 'required',
            'mobile_no' => 'required',
            'dob' => 'required',
            'nic' => 'required',
            'bank_name' => 'required',
            'branch' => 'required',
            'account_number' => 'required',
            'holder_name' => 'required',
            'benificiary_contact_no' => 'required',
            'relationship' => 'required',
            'benificiary_name' => 'required',
        ];
    }
}
