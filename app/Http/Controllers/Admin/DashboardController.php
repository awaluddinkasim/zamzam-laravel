<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'konsumen' => User::all()->count(),
            'barang' => Barang::all()->count(),
            'pesananSelesai' => Order::where('status', 'Selesai')->get()->count(),
            'pesananPending' => Order::where('status', 'Pending')->get()->count(),
            'belumLunas' => Order::where('status', 'Belum Lunas')->get()->count(),
            'lunas' => Order::where('status', 'Lunas')->get()->count(),
            'grafik' => [
                Order::whereMonth('tgl_penyewaan', '1')->get()->sum('dibayar'),
                Order::whereMonth('tgl_penyewaan', '2')->get()->sum('dibayar'),
                Order::whereMonth('tgl_penyewaan', '3')->get()->sum('dibayar'),
                Order::whereMonth('tgl_penyewaan', '4')->get()->sum('dibayar'),
                Order::whereMonth('tgl_penyewaan', '5')->get()->sum('dibayar'),
                Order::whereMonth('tgl_penyewaan', '6')->get()->sum('dibayar'),
                Order::whereMonth('tgl_penyewaan', '7')->get()->sum('dibayar'),
                Order::whereMonth('tgl_penyewaan', '8')->get()->sum('dibayar'),
                Order::whereMonth('tgl_penyewaan', '9')->get()->sum('dibayar'),
                Order::whereMonth('tgl_penyewaan', '10')->get()->sum('dibayar'),
                Order::whereMonth('tgl_penyewaan', '11')->get()->sum('dibayar'),
                Order::whereMonth('tgl_penyewaan', '12')->get()->sum('dibayar'),
            ],
        ];



        return view('pages.dashboard', $data);
    }
}
