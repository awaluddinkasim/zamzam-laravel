<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\BarangVarian;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BarangController extends Controller
{
    public function index()
    {
        $data = [
            'daftarBarang' => Barang::all()
        ];

        return view('pages.barang', $data);
    }

    public function store(Request $request)
    {
        try {
            $gambar = $request->file('img');
            $filename = uniqid() . '.' . $gambar->extension();

            $barang = new Barang();
            $barang->kode = $request->kode;
            $barang->nama = $request->nama;
            $barang->harga = convertToNumeric($request->harga);
            $barang->kategori = $request->kategori;
            $barang->deskripsi = $request->deskripsi;
            $barang->img = $filename;
            $barang->save();

            $gambar->move(public_path('files/barang'), $filename);

            return redirect()->route('barang.detail', $barang->kode)->with('success', 'Berhasil menambah barang');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == "1062") {
                return redirect()->back()->with('error', 'Barang dengan kode tersebut sudah ada');
            }
            return redirect()->back()->with('error', 'Terjadi kesalahan');
        }
    }

    public function storeVarian(Request $request)
    {
        $varian = new BarangVarian();
        $varian->kode_barang = $request->barang;
        $varian->nama = $request->nama;
        $varian->stok = convertToNumeric($request->stok);
        $varian->save();

        return redirect()->back()->with('success', 'Varian berhasil ditambah');
    }

    public function detail(Barang $barang)
    {
        $data = [
            'barang' => Barang::find($barang->kode)
        ];

        return view('pages.barang_detail', $data);
    }

    public function update(Request $request)
    {
        if ($request->has('img')) {
            $gambar = $request->file('img');
            $filename = uniqid() . '.' . $gambar->extension();
        }

        $barang = Barang::find($request->kode);
        $barang->nama = $request->nama;
        $barang->harga = $request->harga;
        $barang->kategori = $request->kategori;
        $barang->deskripsi = $request->deskripsi;
        if (isset($gambar)) {
            File::delete(public_path('files/barang/' . $barang->img));

            $barang->img = $filename;
            $gambar->move(public_path('files/barang'), $filename);
        }
        $barang->update();

        return redirect()->route('barang')->with('success', 'Berhasil update barang');
    }

    public function delete(Request $request)
    {
        $barang = Barang::find($request->kode);
        File::delete(public_path('files/barang/' . $barang->img));
        $barang->delete();

        return redirect()->route('barang')->with('success', 'Barang berhasil dihapus');
    }


    public function deleteVarian(Request $request)
    {
        $varian = BarangVarian::find($request->id);
        $varian->delete();

        return redirect()->back()->with('success', 'Varian berhasil dihapus');
    }
}
