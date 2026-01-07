<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller; // ✅ WAJIB
use Illuminate\Http\Request;

class LoginController extends Controller // ✅ WAJIB
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }
}
