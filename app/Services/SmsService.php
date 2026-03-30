<?php

namespace App\Services;

use App\Models\SmsLog;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SmsService
{


    public function sendOTP(string $mobileNo)
    {
        $formattedMobile = $this->formatMobileNo($mobileNo);
        if ($formattedMobile === '' || strlen($formattedMobile) < 11) {
            Log::channel('sms')->warning('sendOTP : invalid mobile after format', ['raw' => $mobileNo]);

            return null;
        }
        $data = (object) [
            "source" => "Equest.lk",
            "transport" =>  "sms",
            "destination" => $formattedMobile
        ];

        Log::channel('sms')->info('mobile no ' . $formattedMobile);

        $res =  Http::withHeaders([
            'Authorization' => 'Bearer ' . env('SMS_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post(
            'https://api.getshoutout.com/otpservice/send',
            $data
        );

        $res = json_decode($res, TRUE);

        Log::channel('sms')->info('sendOTP : res ' . json_encode($res));

        if (isset($res['referenceId'])) {
            Log::channel('sms')->info('sendOTP : referenceId ' . $res['referenceId']);
            return $res['referenceId'];
        }
        return null;
    }

    public function verifyOTP($otp, $referenceId): bool
    {

        $data = (object) [

            "code" => $otp,
            "referenceId" =>  $referenceId,

        ];

        Log::info(json_encode($data));

        $res =  Http::withHeaders([
            'Authorization' => 'Bearer ' .  env('SMS_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post(
            'https://api.getshoutout.com/otpservice/verify',
            $data
        );
        $res = json_decode($res, TRUE);
        Log::channel('sms')->info('verifyOTP : res ' . json_encode($res));
        if (isset($res['statusCode'])) {
            if ($res['statusCode'] == SmsLog::STATUS['OTP_VERIFIED']) {

                Log::channel('sms')->info('verifyOTP : statusCode ' . $res['statusCode']);
                return true;
            }
        }
        return false;
    }

    public function sendMsg($mobileNo, $msg): bool
    {
        $formattedMobile = $this->formatMobileNo((string) $mobileNo);
        if ($formattedMobile === '' || strlen($formattedMobile) < 11) {
            Log::channel('sms')->warning('sendMsg : invalid mobile after format', ['raw' => $mobileNo]);

            return false;
        }

        $data = (object) [
            "source" => "Equest.lk",
            "destinations" => [$formattedMobile],
            "content" =>   (object) [
                "sms" => $msg
            ],
            "transports" => ["sms"]

        ];

        Log::info(json_encode($data));

        $res =  Http::withHeaders([
            'Authorization' => 'Bearer ' .  env('SMS_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post(
            'https://api.getshoutout.com/coreservice/messages',
            $data
        );
        $res = json_decode($res, TRUE);
        Log::channel('sms')->info('sendMsg : res ' . json_encode($res));
        if (isset($res['status'])) {
            if ($res['status'] == SmsLog::STATUS['SEND_MSG_SUCCESS']) {

                Log::channel('sms')->info('sendMsg : status ' . $res['status']);
                return true;
            }
        }
        Log::channel('sms')->warning('sendMsg : provider did not return success', ['res' => $res]);

        return false;
    }

    /**
     * Sri Lanka mobile for GetShoutout: digits only, always "94" + 9-digit mobile (e.g. 94771234567).
     * Handles local 077…, 94…, +94…, and spaced/punctuated input.
     */
    private function formatMobileNo(string $mobileNo): string
    {
        $digits = preg_replace('/\D+/', '', $mobileNo) ?? '';

        if ($digits === '') {
            return '';
        }

        if (strlen($digits) === 11 && str_starts_with($digits, '94')) {
            return $digits;
        }

        if (strlen($digits) === 10 && str_starts_with($digits, '0')) {
            return '94'.substr($digits, 1);
        }

        if (strlen($digits) === 9) {
            return '94'.$digits;
        }

        if (strlen($digits) >= 9) {
            return '94'.substr($digits, -9);
        }

        return '94'.$digits;
    }
}
