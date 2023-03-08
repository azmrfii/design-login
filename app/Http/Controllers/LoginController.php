<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function processLoginMasyarakat(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
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

    public function register(Request $request)
    {
        $data = $request->all();

        $date = Carbon::now();

        $masyarakat = new Masyarakat();
        $masyarakat->email = $data['email'];
        $masyarakat->password = Hash::make($data['password']);
        $masyarakat->nik = $data['nik'];
        $masyarakat->name = $data['name'];
        $masyarakat->username = $data['username'];
        $masyarakat->jk = $data['jk'];
        $masyarakat->no_hp = $data['no_hp'];
        $masyarakat->alamat = $data['alamat'];
        $masyarakat->tgl_join = $date->toDateTimeString();

        // ddd($masyarakat);
        $masyarakat->save();

        // $date = Carbon::now();

        // $validatedData = $request->validate([
        //     'nik' => 'required',
        //     'name' => 'required',
        //     'username' => 'required',
        //     'jk' => 'required',
        //     'no_hp' => 'required',
        //     'alamat' => 'required',
        //     'email' => 'required',
        //     'password' => 'required',
        //     'tgl_join' => $date->toDateTimeString(),
        // ]);

        // $validatedData['password'] = Hash::make($validatedData['password']);

        // dd($validatedData);
        // Masyarakat::create($validatedData);

        return redirect()->route('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();    
        $request->session()->regenerateToken();
    
        return redirect()->route('login');
    }
}
