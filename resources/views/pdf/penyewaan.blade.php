<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Penyewaan</title>
</head>

<body>
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
            <th>Kategori</th>
            <th>Harga</th>
            <th>Jumlah</th>
        </tr>
        @forelse ($order->items as $item)
            <tr>
                <td>{{ $loop->iteration }}.</td>
                <td>{{ $item->barang->nama }}</td>
                <td>{{ $item->barang->kategori }}</td>
                <td>Rp. {{ number_format($item->barang->harga) }}</td>
                <td>{{ $item->qty }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" style="text-align: center">Tidak ada item</td>
            </tr>
        @endforelse
    </table>

</body>

</html>
