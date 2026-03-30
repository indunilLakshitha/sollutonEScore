<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPasswordManagerController extends Controller
{
    public function index()
    {
        return view('Admin.Password.index');
    }

    public function edit($id)
    {
        if (Auth::user()->is_admin)
            return view('Admin.Password.edit', compact('id'));

        return abort(404);
    }
}
