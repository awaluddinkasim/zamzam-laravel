@extends('layout')

@section('title', 'Data Penyewaan Telah Lunas')

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="table" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Konsumen</th>
                            <th>No. HP</th>
                            <th>Tanggal Penyewaan</th>
                            <th>Jumlah Barang</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $order->konsumen->nama }}</td>
                                <td>{{ $order->konsumen->no_hp }}</td>
                                <td>{{ Carbon\Carbon::parse($order->tgl_penyewaan)->isoFormat('D MMMM YYYY') }}</td>
                                <td>{{ $order->items->count() }}</td>
                                <td>{!! $order->status == 'Selesai'
                                    ? '<span class="text-success">Selesai</span>'
                                    : '<span class="text-danger">Belum Selesai</span>' !!}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm"
                                        onclick="document.location.href = '{{ route('penyewaan.lunas.detail', $order->id) }}'">Detail</button>
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
