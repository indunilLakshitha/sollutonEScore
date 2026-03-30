<?php

namespace App\Traits;

use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;

trait ErrorLogTrait
{
    use ResponseTrait;
    /* 
        $type = api | web
    */
    public function addToApiErrorLog($type, $e, $function_name)
    {
       

        $user_id = Auth::user()?->id ?? 0;
        $msg = $e->getMessage()  ?? "";
        $function_name = $function_name ?? "";


        if ($type == 'api') {
            \Log::channel('api_er')->info('[user_id :' . $user_id  . '][' . $function_name . '][' . $msg . ']');
        }

        return $this->sendError();
    }

    public function addToErrorLog($type, $e, $function_name)
    {
        \Log::channel('api_er')->info('[user_id :' . 1  . '][' . $function_name . '][' . $e . ']');
        // $user_id = Auth::user()?->id ?? 0;
        // $msg = $e->getMessage()  ?? "";
        // $function_name = $function_name ?? "";


        // if ($type == 'api') {
        //     \Log::channel('api_er')->info('[user_id :' . $user_id  . '][' . $function_name . '][' . $msg . ']');
        // }

    }
}
