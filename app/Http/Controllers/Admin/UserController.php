<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'users' => User::orderBy('nama')->get()
        ];

        return view('pages.users', $data);
    }

    public function detail(User $user)
    {
        $data = [
            'user' => $user
        ];

        return view('pages.user_detail', $data);
    }

    public function delete(User $user)
    {
        $user = User::find($user->id);
        $user->delete();

        return redirect()->back()->with("success", "Konsumen berhasil dihapus");
    }
}
