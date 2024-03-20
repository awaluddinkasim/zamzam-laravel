@extends('layout')

@section('title', 'Data Barang')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 text-center d-none d-md-block">
                    <img src="{{ asset('assets/images/svg/barang.svg') }}" alt="" class="w-75">

                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Tambah
                    </button>

                    <div class="table-responsive">
                        <table id="table" class="table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Stok</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($daftarBarang as $barang)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $barang->kode }}</td>
                                        <td>{{ $barang->nama }}</td>
                                        <td>Rp. {{ number_format($barang->harga) }}</td>
                                        <td>{{ number_format($barang->varian->sum('stok')) }}</td>
                                        <td>
                                            <button class="btn btn-primary btn-sm"
                                                onclick="document.location.href = '{{ route('barang.detail', $barang->kode) }}'">
                                                Detail
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Form Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('barang.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode Barang</label>
                            <input type="text" class="form-control" id="kode" name="kode" maxlength="5"
                                autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="text" class="form-control" id="harga" name="harga" autocomplete="off"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori" required>
                                <option value="" hidden selected>Pilih</option>
                                <option value="Paket">Paket</option>
                                <option value="Non Paket">Non Paket</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="img" class="form-label">Gambar</label>
                            <input type="file" accept=".jpg, .jpeg, .png" class="form-control" id="img"
                                name="img" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
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
    <script src="{{ asset('assets/js/autonumeric.js') }}"></script>

    <script>
        new AutoNumeric('#harga', {
            allowDecimalPadding: false
        })

        $(document).ready(function() {
            $('#table').DataTable({
                sort: false
            });
        });
    </script>
    @include('includes.sweetalert')
@endpush
