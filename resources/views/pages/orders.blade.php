@extends('layout')

@section('title', 'Pesanan Masuk')

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
                                <td>
                                    <button class="btn btn-success btn-sm"
                                        onclick="document.location.href = '{{ route('orders.detail', $order->id) }}'">Terima</button>
                                    <button class="btn btn-danger btn-sm"
                                        onclick="hapus('{{ $order->id }}')">Hapus</button>
                                    <form action="{{ route('orders.delete') }}" method="post"
                                        id="formDelete{{ $order->id }}">
                                        @method('DELETE')
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $order->id }}" required>
                                    </form>
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

        function hapus(id) {
            Swal.fire({
                title: "Anda yakin?",
                text: "Data yang terhapus tak dapat dikembalikan",
                icon: "warning",
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#formDelete${id}`).submit()
                }
            });
        }
    </script>
    @include('includes.sweetalert')
@endpush
