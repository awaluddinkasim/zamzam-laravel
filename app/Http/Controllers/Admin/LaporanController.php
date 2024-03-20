<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $data = [
            'orders' => Order::where('status', 'Selesai')->get()
        ];

        return view('pages.export', $data);
    }

    public function export(Order $order)
    {
        $data = [
            'order' => $order
        ];

        $pdf = Pdf::loadView('pdf.penyewaan', $data);
        return $pdf->stream();
    }

    public function exportAll()
    {
        $data = [
            'orders' => Order::where('status', 'Selesai')->get()
        ];

        $pdf = Pdf::loadView('pdf.data_penyewaan', $data);
        return $pdf->stream();
    }
}
