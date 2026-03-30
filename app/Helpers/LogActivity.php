<?php


namespace App\Helpers;

use App\Models\ActivityLog;
use App\Models\ErrorLogDb;
use Request;

class LogActivity
{
    public static function addToLog($subject)
    {
        $log = [];
        $log['subject'] = $subject;
        $log['url'] = Request::fullUrl();
        $log['method'] = Request::method();
        $log['ip'] = Request::ip();
        $log['agent'] = Request::header('user-agent');
        $log['user_id'] = auth()->check() ? auth()->user()->id : 1;
        ActivityLog::create($log);
    }


    public static function logActivityLists()
    {
        return ActivityLog::latest()->get();
    }

    public static function addToErrorLog($subject, $error)
    {
        $log = [];
        $log['subject'] = $subject;
        $log['error'] = $error;
        $log['url'] = Request::fullUrl();
        $log['method'] = Request::method();
        $log['ip'] = Request::ip();
        $log['agent'] = Request::header('user-agent');
        $log['user_id'] = auth()->check() ? auth()->user()->id : 1;
        ErrorLogDb::create($log);
    }
}
