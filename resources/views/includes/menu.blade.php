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
            </ul>
        </nav>
    </div>
</div>
