<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait ActivityLogTrait
{
    public function addToLog(string $msg)
    {
        \App\Helpers\LogActivity::addToLog($msg);
    }
}
