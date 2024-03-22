@extends('layout')

@section('title', 'Detail Penyewaan')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">

                <div class="col-md-6 d-none d-md-flex justify-content-center align-items-center">
                    <img src="{{ asset('assets/images/svg/done.svg') }}" alt="" class="w-75">
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
                        @if ($order->status == 'Selesai')
                            <tr>
                                <td>Tanggal Selesai</td>
                                <td class="px-2">:</td>
                                <td>{{ Carbon\Carbon::parse($order->tgl_selesai)->isoFormat('D MMMM YYYY') }}</td>
                            </tr>
                        @endif
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
                                @if ($order->items)
                                    <tr>
                                        <td colspan="6" class="text-end fw-bold">
                                            Subtotal
                                        </td>
                                        <td>Rp. {{ number_format($order->subtotal_harga) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="text-end fw-bold">
                                            Total selama {{ $order->hari }} hari
                                        </td>
                                        <td>Rp. {{ number_format($order->total_harga) }}</td>
                                    </tr>
                                @endif
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
                                            <a href="{{ asset('files/payments/' . $payment->bukti_pembayaran) }}"
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

                    @if ($order->status != 'Selesai')
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal"
                                data-bs-target="#orderModal" {{ isset($disabled) ? 'disabled' : '' }}>
                                Tandai Telah Selesai
                            </button>
                        </div>
                    @else
                        <div class="alert alert-success text-center py-2" role="alert">
                            Pesanan ini telah selesai
                        </div>
                    @endif
                </div>


            </div>
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="orderModalLabel">Selesai</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('penyewaan.lunas.update') }}" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="id" value="{{ $order->id }}" required>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="tgl_selesai" class="form-label">Tanggal Selesai</label>
                            <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai"
                                autocomplete="off" required>
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
