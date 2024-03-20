@extends('layout')

@section('title', 'Data Barang')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <div class="text-center">
                        <img src="{{ asset('files/barang/' . $barang->img) }}" alt="" class="rounded mb-4 mt-2"
                            style="max-width: 350px; max-height: 300px">
                    </div>
                    <div class="mb-3">
                        <label class="form-label-static">Kode Barang</label>
                        <input type="text" class="form-control-plaintext" maxlength="5" autocomplete="off"
                            value="{{ $barang->kode }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label-static">Nama Barang</label>
                        <input type="text" class="form-control-plaintext" autocomplete="off" value="{{ $barang->nama }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label-static">Harga</label>
                        <input type="text" step="1000" class="form-control-plaintext"
                            value="Rp. {{ number_format($barang->harga) }}" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label-static">Kategori</label>
                        <input type="text" class="form-control-plaintext" value="{{ $barang->kategori }}"
                            autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label-static">Deskripsi</label>
                        <textarea class="form-control-plaintext" rows="3" required>{{ $barang->deskripsi }}</textarea>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Varian Barang</h5>
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#tambahVarianModal">Tambah</button>
                    </div>

                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Varian</th>
                                <th scope="col">Stok</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($barang->varian as $varian)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $varian->nama }}</td>
                                    <td>{{ number_format($varian->stok) }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-danger btn-sm"
                                            onclick="hapusVarian({{ $varian->id }})">Hapus</button>
                                        <form action="{{ route('barang.varian.delete') }}" method="post"
                                            id="formDelete{{ $varian->id }}">
                                            @method('DELETE')
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $varian->id }}" required>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="card-footer d-flex justify-content-between">
            <button class="btn btn-primary" onclick="document.location.href = '{{ route('barang') }}'">Kembali</button>
            <div>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal">
                    Edit
                </button>
                <button class="btn btn-danger" onclick="hapus()">Hapus</button>
                <form action="{{ route('barang.delete') }}" method="post" id="formDelete">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="kode" value="{{ $barang->kode }}" required>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('modals')
    <div class="modal fade" id="tambahVarianModal" tabindex="-1" aria-labelledby="tambahVarianModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahVarianModalLabel">Form Varian</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('barang.varian.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="barang" value="{{ $barang->kode }}">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Varian</label>
                            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="text" class="form-control" id="stok" name="stok" autocomplete="off"
                                required>
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


    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Barang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('barang.update') }}" method="post" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kode" class="form-label">Kode Barang</label>
                            <input type="text" class="form-control" id="kode" name="kode" maxlength="5"
                                autocomplete="off" value="{{ $barang->kode }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Barang</label>
                            <input type="text" class="form-control" id="nama" name="nama" autocomplete="off"
                                value="{{ $barang->nama }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="text" step="1000" class="form-control" id="harga" name="harga"
                                value="{{ $barang->harga }}" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select" id="kategori" name="kategori" required>
                                <option value="" hidden selected>Pilih</option>
                                <option value="Paket" {{ $barang->kategori == 'Paket' ? 'selected' : '' }}>Paket</option>
                                <option value="Non Paket" {{ $barang->kategori == 'Non Paket' ? 'selected' : '' }}>Non
                                    Paket
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required>{{ $barang->deskripsi }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="img" class="form-label">Ganti Gambar</label>
                            <input type="file" accept=".jpg, .jpeg, .png" class="form-control" id="img"
                                name="img" autocomplete="off">
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
@endpush

@push('styles')
    <style>
        .form-label-static {
            font-weight: bold;
            margin-bottom: .5rem;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('assets/js/autonumeric.js') }}"></script>

    <script>
        new AutoNumeric('#harga', {
            allowDecimalPadding: false
        })

        new AutoNumeric('#stok', {
            allowDecimalPadding: false
        })

        function hapus() {
            Swal.fire({
                title: "Anda yakin?",
                text: "Data yang terhapus tak dapat dikembalikan",
                icon: "warning",
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#formDelete").submit()
                }
            });
        }

        function hapusVarian(id) {
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
