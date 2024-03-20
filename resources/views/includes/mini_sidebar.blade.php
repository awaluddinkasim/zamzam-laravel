<!--start mini sidebar-->
<aside class="mini-sidebar d-flex align-items-center flex-column justify-content-between">
    <div class="user">
        <a href="#offcanvasUserDetails" data-bs-toggle="offcanvas" class="user-icon">
            <i class="material-icons-outlined">account_circle</i>
        </a>
    </div>
    <div class="quick-menu">
        <nav class="nav flex-column gap-1">
            <a class="nav-link" href="{{ route('dashboard') }}"><i class="material-icons-outlined">home</i></a>
            @if (auth()->user()->level == 'admin')
                <a class="nav-link" href="{{ route('barang') }}"><i class="material-icons-outlined">inventory_2</i></a>
                <a class="nav-link" href="{{ route('orders') }}"><i class="material-icons-outlined">archive</i></a>
                <a class="nav-link" href="{{ route('laporan') }}"><i
                        class="material-icons-outlined">picture_as_pdf</i></a>
            @endif
            <a class="nav-link" href="{{ route('logout') }}"><i
                    class="material-icons-outlined">power_settings_new</i></a>
        </nav>
    </div>
    <div class="mini-footer dark-mode">

    </div>
</aside>
<!--end mini sidebar-->
