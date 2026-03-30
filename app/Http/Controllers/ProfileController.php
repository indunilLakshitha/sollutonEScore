<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $id = Auth::user()->id;
        return view('User.Profile.edit', compact('id'));
    }
}
