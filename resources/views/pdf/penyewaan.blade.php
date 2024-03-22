<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Penyewaan</title>
    <style>
        .kop img {
            position: absolute;
            top: 0;
            left: 0;
        }

        .kop {
            text-align: center;
            margin-bottom: 20px;
        }

        .kop .sekretariat {
            border-top: 1px solid black;
            border-bottom: 1px solid black;
        }
    </style>
</head>

<body>
    <div class="kop">
        <img src="{{ asset('assets/images/logo.png') }}" alt="" style="width: 120px">
        <h1 style="margin-bottom: 0">Zam-zam</h1>
        <h2 style="margin-top: 0">Salon & Rumah Pengantin</h2>
        <div class="sekretariat">Alamat: Jl. Sukamaju II no. 8 Tamamaung, Kec. Panakukkang, Kota Makassar, Sulawesi
            Selatan</div>
    </div>

    <h3>Data Pesanan</h3>
    <table>
        <tr>
            <td>Nama Konsumen</td>
            <td>:</td>
            <td>{{ $order->konsumen->nama }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $order->konsumen->alamat }}</td>
        </tr>
        <tr>
            <td>No. HP</td>
            <td>:</td>
            <td>{{ $order->konsumen->no_hp }}</td>
        </tr>
        <tr>
            <td>Tanggal Penyewaan</td>
            <td>:</td>
            <td>{{ Carbon\Carbon::parse($order->tgl_penyewaan)->isoFormat('D MMMM YYYY') }}</td>
        </tr>
        <tr>
            <td>Tanggal Selesai</td>
            <td>:</td>
            <td>{{ Carbon\Carbon::parse($order->tgl_selesai)->isoFormat('D MMMM YYYY') }}</td>
        </tr>
        <tr>
            <td>Jumlah Dibayar</td>
            <td>:</td>
            <td>Rp. {{ number_format($order->dibayar) }}</td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td>:</td>
            <td>{{ $order->keterangan ?? '-' }}</td>
        </tr>
    </table>

    <h3>Daftar Barang</h3>
    <table style="width: 100%" border="1" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Varian</th>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Total</th>
        </tr>
        @forelse ($order->items as $item)
            <tr>
                <td>{{ $loop->iteration }}.</td>
                <td>{{ $item->varian->barang->nama }}</td>
                <td>{{ $item->varian->nama }}</td>
                <td>{{ $item->varian->barang->kategori }}</td>
                <td>{{ $item->qty }}</td>
                <td>Rp. {{ number_format($item->varian->barang->harga) }}</td>
                <td>Rp. {{ number_format($item->total) }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" style="text-align: center">Tidak ada item</td>
            </tr>
        @endforelse
        @if ($order->items)
            <tr>
                <td colspan="6">
                    Subtotal
                </td>
                <td>Rp. {{ number_format($order->subtotal_harga) }}</td>
            </tr>
            <tr>
                <td colspan="6">
                    Total selama {{ $order->hari }} hari
                </td>
                <td>Rp. {{ number_format($order->total_harga) }}</td>
            </tr>
        @endif
    </table>

    <div style="margin-left: 500px; margin-top: 40px">
        <div>Mengetahui,</div>
        <div style="height: 80px"></div>
        <div>{{ $pengaturan['pemilik'] }}</div>
    </div>

</body>

</html>
