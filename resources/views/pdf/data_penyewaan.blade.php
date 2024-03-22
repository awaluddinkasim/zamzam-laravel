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

    <h3 style="margin: 0; padding: 0">Data Penyewaan</h3>
    <p style="margin-top: 0">Tanggal {{ Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }}</p>
    <table style="width: 100%" border="1" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama Konsumen</th>
            <th>No. HP</th>
            <th>Jumlah Barang</th>
            <th>Tgl Penyewaan</th>
            <th>Tgl Selesai</th>
            <th>Jumlah Dibayar</th>
        </tr>
        @forelse ($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}.</td>
                <td>{{ $order->konsumen->nama }}</td>
                <td>{{ $order->konsumen->no_hp }}</td>
                <td>{{ $order->items->count() }}</td>
                <td>{{ Carbon\Carbon::parse($order->tgl_penyewaan)->isoFormat('D MMMM YYYY') }}</td>
                <td>{{ Carbon\Carbon::parse($order->tgl_selesai)->isoFormat('D MMMM YYYY') }}</td>
                <td>Rp. {{ number_format($order->dibayar) }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" style="text-align: center">Tidak ada item</td>
            </tr>
        @endforelse
    </table>

    <div style="margin-left: 500px; margin-top: 40px">
        <div>Mengetahui,</div>
        <div style="height: 80px"></div>
        <div>{{ $pengaturan['pemilik'] }}</div>
    </div>
</body>

</html>
