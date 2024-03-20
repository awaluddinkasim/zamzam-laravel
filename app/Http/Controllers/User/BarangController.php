<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\BarangResource;
use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function get(Request $request)
    {
        if ($request->has('kode')) {
            $barang = Barang::find($request->kode);

            return response()->json([
                'barang' => new BarangResource($barang)
            ], 200);
        }

        $barang = Barang::has('varian')->get();

        return response()->json([
            'daftarBarang' => BarangResource::collection($barang)
        ], 200);
    }
}
