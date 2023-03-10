<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">

        
        
    @if($info->icon_web == '' || $info->icon_web == null)
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
    @else
        <div class="sidebar-brand-icon">
            <img src="{{asset('/img/uploaded')}}/{{ $info->icon_web }}" style="width: 50px; background-color: rgba(0,0,0,.1)" class="img-thumbnail rounded" alt="">
        </div>
    @endif
        <div class="sidebar-brand-text mx-3">{{ $info->nama_web }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item 
            @if(Route::is('dashboard'))
            active
            @endif">
        <a class="nav-link" href="{{route('dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>

    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item @if(Route::is('barang') || Route::is('penjualan') || Route::is('transaksi'))
            active
            @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Main Data</span>
        </a>
        <div id="collapseTwo" class="collapse @if(Route::is('barang') || Route::is('penjualan') || Route::is('transaksi') || Route::is('pegawai'))
            show
            @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Main Data:</h6>
                <a class="collapse-item
                @if(Route::is('transaksi'))
                active
                @endif" href="{{route('transaksi')}}">Keranjang</a>
                <a class="collapse-item
                @if(Route::is('barang'))
                active
                @endif" href="{{route('barang')}}">Data Barang</a>
                <a class="collapse-item
                @if(Route::is('penjualan'))
                active
                @endif" href="{{route('penjualan')}}">Data Penjualan</a>
                @if(auth()->user()->level == 1)
                <a class="collapse-item
                @if(Route::is('pegawai'))
                active
                @endif" href="{{route('pegawai')}}">Data Pegawai</a>
                @endif
            </div>
        </div>
    </li>

    @if(auth()->user()->level == 1)
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item  @if(Route::is('properti'))
                active
                @endif">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Settings</span>
        </a>
        <div id="collapseUtilities" class="collapse @if(Route::is('properti') || Route::is('info'))
                show
                @endif" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Pengaturan Situs ini:</h6>
                <a class="collapse-item  @if(Route::is('properti'))
                active
                @endif" href="{{route('properti')}}">Properties</a>
                <a class="collapse-item  @if(Route::is('info'))
                active
                @endif" href="{{route('info')}}">Info Web</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @endif
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>