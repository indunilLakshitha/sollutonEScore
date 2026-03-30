<?php

namespace App\Livewire\Register;

use App\Jobs\SendMailJob;
use App\Models\Branch;
use App\Models\Course;
use App\Models\DashboardCity;
use App\Models\DashboardDistrict;
use App\Models\MailDetail;
use App\Models\MasterData;
use App\Models\User;
use App\Models\UserPuchasedCourse;
use App\Rules\MobileNoalidation;
use App\Rules\NICValidation;
use App\Services\UserService;
use App\Traits\CourseTrait;
use App\Traits\UniqueIdTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class CustomerRegister extends Component
{
    use UniqueIdTrait, CourseTrait;

    public $first_name, $last_name, $name, $email, $mobile_no, $nic, $password, $confirm_password,
        $payment_type, $address, $selected_course, $purchased_percent = 1, $zip, $city, $postal, $dob;
    public $payment_details = false;
    public $userId;
    public $user, $paid_amount;
    public $referral_id;
    public $courses, $gender;
    public $districts  = [], $selected_district;
    public $cities  = [], $selected_city, $branch;



    public function mount($referral_id)
    {
        $this->referral_id = $referral_id;
        $this->courses = Course::where('has_website', 1)->get();
        $this->districts = DashboardDistrict::all();
    }

    public function render()
    {
        return view('livewire.register.customer-register');
    }

    public function getCities()
    {
        $this->cities = DashboardCity::where('district_id', $this->selected_district)->get();
    }

    public function registerCustomer()
    {


        $this->validate([
            'referral_id' => 'sometimes|numeric',
            'first_name' => 'required|string|not_regex:/[@#$%^&*();><]/',
            'selected_course' => 'required|string',
            // 'payment_type' => 'required',
            'last_name' => 'required|string|not_regex:/[@#$%^&*();><]/',
            'nic' =>  ['required', new NICValidation],
            'address' => 'required|not_regex:/[@#$%^&*();><]/',
            'selected_district' => 'required|exists:dashboard_districts,id|not_regex:/[@#$%^&*();><]/',
            'gender' => 'required|not_regex:/[@#$%^&*();><]/',
            'selected_city' => 'required|exists:dashboard_cities,id|not_regex:/[@#$%^&*();><]/',
            'address' => 'required|not_regex:/[@#$%^&*();><]/',
            'branch' => 'required|not_regex:/[@#$%^&*();><]/',
            'dob' => 'required|date',
            // 'purchased_percent' => 'required',
            'email' => 'required|email',
            'mobile_no' => ['required', 'numeric', new MobileNoalidation],

        ]);

        // if ($this->payment_type != User::PAYMENT_TYPE['BANK TRANSFER'])
        //     return $this->dispatch('failed_alert', ['title' => 'Selected Payment Method Not Available At The Moment']);


        $course = Course::find($this->selected_course);

        if (!isset($course)) {
            return $this->dispatch('failed_alert', ['title' => 'Please Select Valid Course']);
        }

        if (isset($this->referral_id)) {
            $referrel = User::find($this->referral_id);
            if (!isset($referrel)) {
                return $this->dispatch('failed_alert', ['title' => 'Invalid Referrel User']);
            }
        }

        if (!in_array($this->gender, User::GENDER_LIST)) {
            return $this->dispatch('failed_alert', ['title' => 'Invalid Gender']);
        }

        if (!in_array($this->branch, Branch::BRANCHES)) {
            return $this->dispatch('failed_alert', ['title' => 'Invalid Branch']);
        }

        try {

            DB::beginTransaction();
            $user = new User();
            $user->name = $this->first_name . ' ' . $this->last_name;
            $user->first_name =  $this->first_name;
            $user->last_name =  $this->last_name;
            $user->mobile_no =  $this->mobile_no;
            $user->nic =  $this->nic;
            $user->email =  $this->email;
            $user->address =  $this->address;
            $user->branch =  $this->branch;
            $user->zip_code =  '12530';
            $user->dashboard_city_id =  $this->selected_city;
            $user->dashboard_district_id =  $this->selected_district;
            $user->gender =  $this->gender;
            $user->postal =  ' ';
            $user->dob = $this->dob;
            $user->is_admin =  0;
            $user->is_customer =  true;
            $user->er_status =  User::NONE;
            $password = $this->rand_string(10);
            $user->password =  Hash::make($password);

            if (isset($this->referral_id) && !$this->referral_id > 0) {
                $this->referral_id = MasterData::first()->default_parent_id;
            }

            $user->referrer_id =  $this->referral_id;
            $user->save();

            $user->unique_id = $this->getUniqueIdForMainUser(id: $user->id);
            $user->reg_no = $this->getCustomId(id: $user->id);
            $user->type = User::MAIN;

            $user->save();
            $this->userId = $user->id;
            $this->user = $user;


            $this->setApplliedCourse(
                userId: $user->id,
                courseId: $this->selected_course,
                type: $this->referral_id ?
                    UserPuchasedCourse::TYPE['REFERRAL'] : UserPuchasedCourse::TYPE['DIRECT'],
                purchasedPercent: $this->purchased_percent
            );

            $user->dummy_a1_id = (new UserService())->addLeftAccount(
                user: $user,
                status: $user->status,
                paymentStatus: $user->payment_status
            )->id;

            $user->dummy_a2_id = (new UserService())->addRightAccount(
                user: $user,
                status: $user->status,
                paymentStatus: $user->payment_status
            )->id;

            $this->clearPasswords();
            DB::commit();

            $details['email'] = $user->email;
            $details['type'] = MailDetail::MAIL_TYPE['REG_SUCCESS'];

            dispatch(new SendMailJob($details));

            // if ($this->payment_type == User::PAYMENT_TYPE['BANK TRANSFER']) {

            $this->payment_details = true;
            // }
        } catch (Exception $e) {

            DB::rollBack();
            Log::error($e->getMessage());
            return $this->dispatch('failed_alert', ['title' => 'User Registered Failed']);
        }
    }

    function rand_string($length)
    {

        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars), 0, $length);
    }


    public function clearPasswords()
    {
        $this->confirm_password = "";
        $this->password = "";
        $this->name = "";
    }

    public function setPaid()
    {
        $user = User::find($this->userId);
        $user->paid = true;
        $user->paid_at = Carbon::now();
        $user->save();

        return $this->dispatch('registered_with_id', [
            'title' => 'Use ' . $this->userId . ' As Your USER ID When Login',
            'detail' => 'Ok, My USER ID is : ' . $this->userId
        ]);
    }
    public function back()
    {
        $this->payment_details = false;
    }
}
