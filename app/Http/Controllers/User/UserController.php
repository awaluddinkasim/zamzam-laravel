<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            $user = new User();
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->alamat = $request->alamat;
            $user->no_hp = $request->no_hp;
            $user->save();

            return response()->json([
                'message' => 'Berhasil'
            ], 200);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == "1062") {
                return response()->json([
                    'message' => 'Akun dengan email tersebut sudah terdaftar'
                ], 400);
            }
            return response()->json([
                'message' => 'Terjadi kesalahan'
            ], 400);
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $user = User::find($request->user()->id);
            $user->nama = $request->nama;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->alamat = $request->alamat;
            $user->no_hp = $request->no_hp;
            $user->update();

            return response()->json([
                'message' => 'Berhasil',
                'user' => $user
            ], 200);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == "1062") {
                return response()->json([
                    'message' => 'Akun dengan email tersebut sudah terdaftar'
                ], 400);
            }
            return response()->json([
                'message' => 'Terjadi kesalahan'
            ], 400);
        }
    }
}
