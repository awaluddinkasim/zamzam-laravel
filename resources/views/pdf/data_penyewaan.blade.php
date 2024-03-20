<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Penyewaan</title>
</head>

<body>
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
</body>

</html>
