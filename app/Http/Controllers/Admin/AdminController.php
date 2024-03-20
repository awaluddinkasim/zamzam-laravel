<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'admins' => Admin::whereNot('level', 'owner')->orderBy('nama')->get()
        ];

        return view('pages.admins', $data);
    }

    public function store(Request $request)
    {
    }

    public function edit(Admin $admin)
    {
    }

    public function update(Request $request)
    {
    }

    public function delete(Request $request)
    {
    }

    public function profile()
    {
        return view('pages.profile');
    }

    public function profileUpdate(Request $request)
    {
        $admin = Admin::find(auth()->user()->id);
        $admin->nama = $request->nama;
        $admin->email = $request->email;
        if ($request->password) {
            $admin->password = Hash::make($request->password);
        }
        $admin->update();

        return redirect()->back()->with('success', 'Update profil berhasil');
    }
}
