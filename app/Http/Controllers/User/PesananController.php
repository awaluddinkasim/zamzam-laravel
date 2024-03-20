<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Barang;
use App\Models\BarangVarian;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderPayment;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function get(Order $order)
    {
        return response()->json([
            'message' => 'Berhasil',
            'order' => new OrderResource($order)
        ], 200);
    }

    public function getAll(Request $request)
    {
        $orders = $request->user()->orders;

        return response()->json([
            'message' => 'Berhasil',
            'orders' => OrderResource::collection($orders)
        ], 200);
    }

    public function post(Request $request)
    {
        $order = new Order();
        $order->user_id = $request->user()->id;
        $order->tgl_penyewaan = $request->tgl_penyewaan;
        $order->status = "Pending";
        $order->save();

        foreach ($request['items'] as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->varian_id = $item['varian']['id'];
            $orderItem->qty = $item['qty'];
            $orderItem->save();

            $varian = BarangVarian::find($item['varian']['id']);
            $varian->stok = $varian->stok - $item['qty'];
            $varian->update();
        }

        return response()->json([
            'message' => 'Berhasil'
        ], 200);
    }

    public function upload(Request $request)
    {
        $file = $request->file('bukti');
        $filename = time() . '.' . $file->extension();

        $payment = new OrderPayment();
        $payment->order_id = $request->order_id;
        $payment->nominal = $request->nominal;
        $payment->bukti_pembayaran = $filename;
        $payment->save();

        $order = Order::find($request->order_id);
        if ($order->dibayar >= $order->total_harga) {
            $order->status = "Lunas";
            $order->update();
        }

        $file->move(public_path('files/payments'), $filename);

        return response()->json([
            'message' => 'Berhasil'
        ], 200);
    }
}
