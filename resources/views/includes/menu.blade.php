<div class="offcanvas offcanvas-start w-260" data-bs-scroll="true" tabindex="-1" id="offcanvasPrimaryMenu">
    <div class="offcanvas-header border-bottom h-70">
        <img src="assets/images/logo1.png" width="160" alt="">
        <a href="javascript:;" class="primaery-menu-close" data-bs-dismiss="offcanvas">
            <i class="material-icons-outlined">close</i>
        </a>
    </div>
    <div class="offcanvas-body">
        <nav class="sidebar-nav">
            <ul class="metismenu" id="sidenav">
                <li>
                    <a href="{{ route('dashboard') }}">
                        <div class="parent-icon"><i class="material-icons-outlined">home</i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>
                </li>
                @if (auth()->user()->level == 'admin')
                    <li>
                        <a href="{{ route('barang') }}">
                            <div class="parent-icon"><i class="material-icons-outlined">inventory_2</i>
                            </div>
                            <div class="menu-title">Data Barang</div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('orders') }}">
                            <div class="parent-icon"><i class="material-icons-outlined">archive</i>
                            </div>
                            <div class="menu-title">Pesanan Masuk</div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="material-icons-outlined">description</i>
                            </div>
                            <div class="menu-title">Data Penyewaan</div>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route('penyewaan.belum-lunas') }}">
                                    <i class="material-icons-outlined">arrow_right</i>
                                    Belum Lunas
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('penyewaan.lunas') }}">
                                    <i class="material-icons-outlined">arrow_right</i>
                                    Lunas
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('laporan') }}">
                            <div class="parent-icon"><i class="material-icons-outlined">picture_as_pdf</i>
                            </div>
                            <div class="menu-title">Laporan</div>
                        </a>
                    </li>
                @endif
                @if (auth()->user()->level == 'owner')
                    <li>
                        <a href="{{ route('admin') }}">
                            <div class="parent-icon"><i class="material-icons-outlined">people</i>
                            </div>
                            <div class="menu-title">Admin</div>
                        </a>
                    </li>
                @endif
                <li>
                    <a href="{{ route('konsumen') }}">
                        <div class="parent-icon"><i class="material-icons-outlined">people</i>
                        </div>
                        <div class="menu-title">Konsumen</div>
                    </a>
                </li>
                <li>
                    <a href="#pengaturanModal" role="button" data-bs-toggle="modal">
                        <div class="parent-icon"><i class="material-icons-outlined">settings</i>
                        </div>
                        <div class="menu-title">Pengaturan</div>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<div class="modal fade" id="pengaturanModal" tabindex="-1" aria-labelledby="pengaturanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="pengaturanModalLabel">Pengaturan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('pengaturan.save') }}" method="post">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="pemilik" class="form-label">Nama Pemilik</label>
                        <input type="text" class="form-control" id="pemilik" name="pemilik" autocomplete="off"
                            value="{{ $pengaturan['pemilik'] }}" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6">

                            <div class="mb-3">
                                <label for="rekening" class="form-label">Nomor Rekening</label>
                                <input type="text" class="form-control" id="rekening" name="rekening"
                                    autocomplete="off" value="{{ $pengaturan['rekening'] }}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="bank" class="form-label">Nama Bank</label>
                                <input type="text" class="form-control" id="bank" name="bank"
                                    autocomplete="off" value="{{ $pengaturan['bank'] }}" required>
                            </div>
                        </div>
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
