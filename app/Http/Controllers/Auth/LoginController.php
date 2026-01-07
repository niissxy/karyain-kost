<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    { 
        $name      = $request->input('name');
        $password   = $request->input('password');

        if(Auth::guard('web')->attempt(['name' => $name, 'password' => $password])) {
            return response()->json([
                'success' => true
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Login Gagal!'
            ], 401);
        }

        //return redirect('login')->with('error', 'Login failed');
    }

    public function logout()
    {
        // Logout user
        Auth::logout();
        // Redirect ke halaman login setelah logout
        return redirect('login')->with('success', 'Logout berhasil');
    }
}
