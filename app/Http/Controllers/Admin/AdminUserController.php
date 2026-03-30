<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('Admin.User.index');
    }

    public function create()
    {
        if (Auth::user()->is_admin)
            return view('Admin.User.create');

        return abort(404);
    }

    public function edit($id)
    {
        if (Auth::user()->is_admin)
            return view('Admin.User.edit', compact('id'));

        return abort(404);
    }
}
