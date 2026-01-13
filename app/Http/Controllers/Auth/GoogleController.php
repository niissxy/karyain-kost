<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')
        ->with([
            'prompt' => 'select_account',
        ])
        ->redirect();

       return Socialite::driver('google')->stateless()->redirect();
    }

    public function callback()
    {
        // Ambil user dari Google
       $googleUser = Socialite::driver('google')->stateless()->user();

        // Update atau buat user baru
        $user = User::updateOrCreate(
            ['email' => $googleUser->email],
            [
                'name' => $googleUser->name,
                'google_id' => $googleUser->id,
                'password' => bcrypt(uniqid()) // random password
            ]
        );

        // Login user
        Auth::login($user);

        // Redirect ke dashboard
        return redirect()->route('dashboard.index');
    }
}
