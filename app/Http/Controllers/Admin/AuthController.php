<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth');
    }

    public function authenticate(Request $request)
    {
        $remember = $request->remember ? true : false;

        $credentials = ['email' => $request->email, 'password' => $request->password];

        if (Auth::attempt($credentials, $remember)) {
            return redirect()->route('dashboard');
        }

        return redirect()->back()->with('error', 'Email atau Password salah');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
