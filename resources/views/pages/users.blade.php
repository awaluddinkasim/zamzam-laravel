@extends('layout')

@section('title', 'Konsumen')

@section('content')

    <div class="card">
        <div class="card-body">
            @if (Session::has('success'))
                <div class="alert alert-success" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif

            <div class="table-responsive">
                <table id="table" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Email</th>
                            <th>Nama Konsumen</th>
                            <th>No. HP</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->nama }}</td>
                                <td>{{ $user->no_hp }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm"
                                        onclick="document.location.href = '{{ route('konsumen.detail', $user->id) }}'">Detail</button>
                                    <form class="d-inline" action="{{ route('konsumen.delete', $user->id) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
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
    </script>
@endpush
