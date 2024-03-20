<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BarangVarian;
use App\Models\Order;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        $data = [
            'orders' => Order::where('status', 'Pending')->get()
        ];

        return view('pages.orders', $data);
    }

    public function detail(Order $order)
    {
        $data = [
            'order' => Order::find($order->id)
        ];

        return view('pages.order_detail', $data);
    }

    public function terima(Request $request)
    {
        $order = Order::find($request->id);
        $order->status = 'Belum Lunas';
        $order->update();

        return redirect()->route('orders')->with('success', 'Pesanan diterima');
    }

    public function delete(Request $request)
    {
        $order = Order::find($request->id);

        foreach ($order->items as $item) {
            $varian = BarangVarian::find($item->varian_id);
            $varian->stok = $varian->stok + $item->qty;
            $varian->update();
        }

        $order->delete();

        return redirect()->route('orders')->with('success', 'Pesanan dihapus');
    }
}
