<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SendForgotPasswordOtpEmail;
use App\Models\SendOtpSmsDetail;
use App\Models\User;
use App\Services\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function notify(Request $request)
    {
        $user = User::where('reg_no', $request->id)->where('mobile_no', $request->mobile)->first();

        if (!isset($user)) {
            return redirect()->back()->withErrors(['error' => 'Invalid Details'])->withInput();
        }

        $referenceId = (new SmsService())->sendOTP($user->mobile_no);

        SendOtpSmsDetail::create([
            'user_id' => $user->id,
            'ref' => $referenceId,
        ]);

        return redirect()->route('forgotPassword.verifyView', [$referenceId]);
    }

    public function verifyView($ref_id)
    {
        return view('auth.verify-otp', compact('ref_id'));
    }

    public function changeView($ref_id)
    {
        $details = SendOtpSmsDetail::where('ref', $ref_id)->first();

        if (!isset($details)) {
            return redirect()->route('login');
        }

        $user_id =  $details->user_id;

        return view('auth.change-password', compact('user_id', 'ref_id'));
    }

    public function verify(Request $request)
    {
        if (!isset($request->otp) || !isset($request->ref_id))
            return redirect()->back();

        $ref_id = $request->ref_id;

        if ((new SmsService())->verifyOTP(otp: $request->otp, referenceId: $request->ref_id)) {
            return redirect()->route('forgotPassword.changeView', [$ref_id]);
        } else {
            return redirect()->back()->withErrors(['error' => 'Invalid OTP']);
        }
    }

    public function change(Request $request)
    {
        $request->validate([
            'password' => 'required|min:6|required_with:confirm_password|same:confirm_password',
            'confirm_password' => 'required|min:6',
            'user_id' => 'required',
        ]);

        $details = SendOtpSmsDetail::where('ref', $request->ref_id)->first();

        if (!isset($details)) {
            return redirect()->route('login');
        }

        if ($details->user_id != $request->user_id)
            return redirect()->back()->withErrors(['error' => 'Invalid User ID']);

        $user = User::find($details->user_id);

        $user->password =  Hash::make($request->password);
        $user->save();

        return redirect()->route('login');
    }
}
