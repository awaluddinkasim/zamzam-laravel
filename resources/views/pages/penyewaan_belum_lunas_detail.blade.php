@extends('layout')

@section('title', 'Detail Penyewaan')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-md-6 d-none d-md-flex justify-content-center align-items-center">
                    <img src="{{ asset('assets/images/svg/akuntan.svg') }}" alt="" class="w-75">
                </div>
                <div class="col-md-6">
                    <h5>Data Pesanan</h5>
                    <table>
                        <tr>
                            <td>Nama Konsumen</td>
                            <td class="px-2">:</td>
                            <td>{{ $order->konsumen->nama }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td class="px-2">:</td>
                            <td>{{ $order->konsumen->alamat }}</td>
                        </tr>
                        <tr>
                            <td>No. HP</td>
                            <td class="px-2">:</td>
                            <td>{{ $order->konsumen->no_hp }}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Penyewaan</td>
                            <td class="px-2">:</td>
                            <td>{{ Carbon\Carbon::parse($order->tgl_penyewaan)->isoFormat('D MMMM YYYY') }}</td>
                        </tr>
                        <tr>
                            <td>Total Harga</td>
                            <td class="px-2">:</td>
                            <td>Rp. {{ number_format($order->total_harga) }}</td>
                        </tr>
                        <tr>
                            <td>Sudah Dibayar</td>
                            <td class="px-2">:</td>
                            <td>Rp. {{ number_format($order->dibayar) }}</td>
                        </tr>
                        <tr>
                            <td>Keterangan</td>
                            <td class="px-2">:</td>
                            <td>{{ $order->keterangan ?? '-' }}</td>
                        </tr>
                    </table>

                    <h5 class="mt-3">Daftar Barang</h5>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Varian</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($order->items as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $item->varian->barang->nama }}</td>
                                        <td>{{ $item->varian->nama }}</td>
                                        <td>{{ $item->varian->barang->kategori }}</td>
                                        <td>Rp. {{ number_format($item->varian->barang->harga) }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>Rp. {{ number_format($item->total) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="6">Tidak ada item</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <h5 class="mt-3">Data Pembayaran</h5>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tanggal Upload</th>
                                    <th scope="col">Nominal</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($order->payments as $payment)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ Carbon\Carbon::parse($payment->created_at)->isoFormat('DD MMMM YYYY') }}
                                        </td>
                                        <td>Rp. {{ number_format($payment->nominal) }}</td>
                                        <td>
                                            <a href="{{ asset('files/payment/' . $payment->bukti_pembayaran) }}"
                                                target="_blank" class="btn btn-primary btn-sm">Lihat</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="4">Belum ada pembayaran</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="orderModalLabel">Lunas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('penyewaan.belum-lunas.update') }}" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id" value="{{ $order->id }}" required>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="dibayar" class="form-label">Dibayar</label>
                            <input type="number" step="1000" class="form-control" id="dibayar" name="dibayar"
                                value="{{ $order->total_harga }}" autocomplete="off" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan (opsional)</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ $order->keterangan }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
