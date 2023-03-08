<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('welcome');
    }

    public function processLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        // Check login as web
        if(Auth::guard('web')->attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        // Check Login as masyarakat
        if(Auth::guard('masyarakat')->attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->intended('home');
        }
        // Email notification not found
        return back()->withErrors([
            'email' => 'We did not find your email.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();    
        $request->session()->regenerateToken();
    
        return redirect()->route('login');
    }
}
