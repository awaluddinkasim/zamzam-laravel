<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function simpan(Request $request)
    {
        foreach ($request->keys() as $key) {
            $pengaturan = Setting::where('key', $key)->first();
            if ($pengaturan) {
                $pengaturan->value = $request->$key;
                $pengaturan->update();
            } else {
                $pengaturan = new Setting();
                $pengaturan->key = $key;
                $pengaturan->value = $request->$key;
                $pengaturan->save();
            }
        }

        return redirect()->back()->with('settings-saved', 'Pengaturan berhasil disimpan');
    }
}
