<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Jobs\SendMailJob;
use App\Jobs\SendSmsJob;
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
use App\Traits\SMSTrait;
use App\Traits\UniqueIdTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class Register extends Component
{
    use UniqueIdTrait, CourseTrait, SMSTrait;

    public $first_name, $last_name, $name, $email, $mobile_no, $nic, $password, $confirm_password,
        $payment_type, $address, $selected_course, $purchased_percent = 1, $zip, $city, $postal, $dob, $is_agree = true;
    public $payment_details = false;
    public $userId;
    public $user, $paid_amount;

    public $courses, $gender;
    public $districts  = [], $selected_district;
    public $cities  = [], $selected_city, $branch;
    public $referral_id, $course_id;

    public function mount($referral_id, $course_id)
    {
        $session_ref = session('referral_id');
        if (strlen($session_ref) > 0) {
            Log::debug('ref ' . $session_ref);
            $this->referral_id = $session_ref;
        } else {

            $this->referral_id = $referral_id;
        }

        // if (session('referral_id')) {
        //     $session_ref =  session('referral_id');
        // }
        // if (isset($session_ref)) {
        //     if (strlen($session_ref) > 1) {
        //         $this->referral_id =  $session_ref;
        //     }
        // }

        $course = Course::where('slug', $course_id)->first();
        if (is_null($course))
            return redirect()->route('index');

        $this->course_id = $course->id;
        $this->selected_course = $course->id;

        $this->courses = Course::where('has_website', 1)->get();
        $this->districts = DashboardDistrict::all();
        Log::alert($this->referral_id);
    }

    public function render()
    {

        return view('livewire.home.register');
    }

    public function getCities()
    {
        try {
            if (empty($this->selected_district)) {
                $this->cities = [];
                $this->selected_city = null;
                return;
            }

            $this->cities = DashboardCity::where('district_id', $this->selected_district)->get();
            $this->selected_city = null; // Reset selected city when district changes
        } catch (Exception $e) {
            Log::error('Error in getCities: ' . $e->getMessage());
            $this->cities = [];
            $this->selected_city = null;
        }
    }

    public function registerCustomer()
    {
        // if (!$this->is_agree) {
        //     return $this->dispatch('failed_alert', ['title' => 'Please Select Agree']);
        // }

        $this->validate([
            'referral_id' => 'sometimes|numeric',
            'first_name' => 'required|string|not_regex:/[@#$%^&*();><]/',
            'selected_course' => 'required',
            // 'payment_type' => 'required',
            'last_name' => 'required|string|not_regex:/[@#$%^&*();><]/',
            'nic' =>  ['required', new NICValidation, 'unique:users'],
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


        $course = Course::where('id', $this->selected_course)->first();
        // $course = Course::find($this->selected_course);

        if (!isset($course)) {
            return $this->dispatch('failed_alert', ['title' => 'Please Select Valid Course']);
        }

        if (isset($this->referral_id) && strlen($this->referral_id) > 1) {
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
            //
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

            $appliedCourse = UserPuchasedCourse::with('course')->where('user_id', $user->id)
                ->where('type', UserPuchasedCourse::TYPE['REFERRAL'])
                ->first();

            $details['email'] = $user->email;
            $details['type'] = MailDetail::MAIL_TYPE['REG_SUCCESS'];
            $details['user_id'] = $user->id;
            $details['first_name'] = $user->first_name;
            $details['mobileNo'] = $user->mobile_no;
            $details['course_name'] = $appliedCourse->course?->name;
            $details['fee'] = $appliedCourse->course?->display_price;
            $details['msg'] = $this->getRegisteredSuccessSms(
                name: $details['first_name'],
                course_name: $details['course_name'],
                amount: $details['fee'],
            );

            dispatch(new SendMailJob($details));
            dispatch(new SendSmsJob($details));

            // if ($this->payment_type == User::PAYMENT_TYPE['BANK TRANSFER']) {

            $this->payment_details = true;
            session::forget('referral_id');
            $url = route('home.checkout', [$this->userId]);
            $escapedUrl = addslashes($url);
            return $this->js("window.location.href = '{$escapedUrl}';");
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


    public function back()
    {
        $this->payment_details = false;
    }
}
