<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = ['email' => $request->email, 'password' => $request->password];

        if (Auth::guard('users')->attempt($credentials)) {
            $user = User::where('email', $request->email)->first();
            $token =  $user->createToken('auth')->plainTextToken;

            return response()->json([
                'message' => 'Berhasil',
                'user' => $user,
                'token' => $token,
            ], 200);
        }

        return response()->json([
            'message' => 'Email atau Password salah'
        ], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Berhasil',
        ], 200);
    }
}
