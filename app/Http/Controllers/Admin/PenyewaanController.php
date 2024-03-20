<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class PenyewaanController extends Controller
{
    public function belumLunas()
    {
        $data = [
            'orders' => Order::where('status', 'Belum Lunas')->get()
        ];

        return view('pages.penyewaan_belum_lunas', $data);
    }

    public function belumLunasDetail(Order $order)
    {
        $data = [
            'order' => Order::where('id', $order->id)->where('status', 'Belum Lunas')->first()
        ];

        return view('pages.penyewaan_belum_lunas_detail', $data);
    }

    public function belumLunasUpdate(Request $request)
    {
        $order = Order::find($request->id);
        $order->dibayar = $request->dibayar;
        $order->status = 'Lunas';
        $order->update();

        return redirect()->route('penyewaan.lunas')->with('success', 'Data berhasil diupdate');
    }

    public function lunas()
    {
        $data = [
            'orders' => Order::where('status', 'Lunas')->orWhere('status', 'Selesai')->get()
        ];

        return view('pages.penyewaan_lunas', $data);
    }

    public function lunasDetail(Order $order)
    {
        $data = [
            'order' => Order::where('id', $order->id)->where(function ($query) {
                return $query->where('status', 'Lunas')->orWhere('status', 'Selesai');
            })->first()
        ];

        return view('pages.penyewaan_lunas_detail', $data);
    }

    public function lunasUpdate(Request $request)
    {
        $order = Order::find($request->id);
        $order->tgl_selesai = $request->tgl_selesai;
        $order->status = 'Selesai';
        $order->update();

        return redirect()->route('penyewaan.lunas')->with('success', 'Data berhasil diupdate');
    }
}
