<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            // Check if the user is activated
            if (Auth::user()->activated != 1) {
                Auth::logout();

                return redirect()->route('login')->withErrors(['email' => 'Your account is not activated.']);
            }

            // Authentication passed, redirect to the intended page
            return redirect()->intended('/home');
        }

        // If login attempt failed, redirect back with an error
        return redirect()->route('login')->withErrors(['email' => 'These credentials do not match our records.']);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }
}
