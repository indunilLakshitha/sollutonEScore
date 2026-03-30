<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('User.User.index');
    }

    public function create()
    {
        if (Auth::user()->is_admin)
            return view('User.Profile.create');

        return abort(404);
        // return view('Admin.User.create');
    }

    public function edit($id)
    {
        return view('User.Profile.edit', compact('id'));
        // return view('Admin.User.edit', compact('id'));
    }
}
