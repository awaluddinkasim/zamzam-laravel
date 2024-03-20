@extends('layout')

@section('title', 'Laporan')

@section('content')
    <div class="card">
        <div class="card-body">
            @if ($orders->count())
                <div class="d-flex justify-content-end mb-3">
                    <button class="btn btn-warning" onclick="window.open('{{ route('laporan.export-all') }}', '_blank')">
                        <i class="material-icons-outlined" style="vertical-align: middle">print</i><span class="ms-1">Cetak
                            Semua</span>
                    </button>
                </div>
            @endif
            <div class="table-responsive">
                <table id="table" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Konsumen</th>
                            <th>No. HP</th>
                            <th>Jumlah Barang</th>
                            <th>Tanggal Penyewaan</th>
                            <th>Tanggal Selesai</th>
                            <th>Jumlah Dibayar</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->konsumen->nama }}</td>
                                <td>{{ $order->konsumen->no_hp }}</td>
                                <td>{{ $order->items->count() }}</td>
                                <td>{{ Carbon\Carbon::parse($order->tgl_penyewaan)->isoFormat('D MMMM YYYY') }}</td>
                                <td>{{ Carbon\Carbon::parse($order->tgl_selesai)->isoFormat('D MMMM YYYY') }}</td>
                                <td>Rp. {{ number_format($order->dibayar) }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm"
                                        onclick="window.open('{{ route('laporan.export', $order->id) }}', '_blank')">Cetak</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                sort: false
            });
        });
    </script>
    @include('includes.sweetalert')
@endpush
