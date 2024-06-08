<div class="sidebar">
    <!-- SidebarSearch Form -->
    <div class="form-inline mt-2">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ url('/') }}" class="nav-link {{ ($activeMenu == 'dashboard')? 'active' : '' }} ">
                    <i class="nav-icon fas fa-home"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            @if(Auth::user()->level_id == 1 || Auth::user()->level_id == 2 )
            <li class="nav-item has-treeview {{ ($activeMenu == 'warga')? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ ($activeSubMenu == 'warga')? 'active' : '' }}">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        Data Warga
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        @if(Auth::user()->level_id == 1)
                        <a href="{{ url('rw/warga') }}" class="nav-link {{ ($activeSubMenu == 'warga_list')? 'active' : '' }}">
                        @elseif (Auth::user()->level_id == 2)
                        <a href="{{ url('rt/warga') }}" class="nav-link {{ ($activeSubMenu == 'warga_list')? 'active' : '' }}">
                        @endif
                            <i class="far nav-icon"></i>
                            <p>Daftar Warga</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        @if(Auth::user()->level_id == 1)
                        <a href="{{ url('rw/keluarga') }}" class="nav-link {{ ($activeSubMenu == 'keluarga_list')? 'active' : '' }}">
                        @elseif (Auth::user()->level_id == 2)
                        <a href="{{ url('rt/keluarga') }}" class="nav-link {{ ($activeSubMenu == 'keluarga_list')? 'active' : '' }}">
                        @endif
                            <i class="far nav-icon"></i>
                            <p>Daftar Keluarga</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        @if (Auth::user()->level_id == 1)
                        <a href="{{ url('rw/kepemilikan') }}" class="nav-link {{ ($activeSubMenu == 'kepemilikan_list')? 'active' : '' }}">
                        @elseif (Auth::user()->level_id == 2)
                        <a href="{{ url('rt/kepemilikan') }}" class="nav-link {{ ($activeSubMenu == 'kepemilikan_list')? 'active' : '' }}">
                        @endif
                            <i class="far nav-icon"></i>
                            <p>Data Kepemilikan</p>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            @if(Auth::user()->level_id == 1 || Auth::user()->level_id == 2 || Auth::user()->level_id == 3 )
            <li class="nav-item has-treeview {{ ($activeMenu == 'kegiatan')? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ ($activeSubMenu == 'kegiatan')? 'active' : '' }}">
                    <i class="nav-icon fas fa-list-alt"></i>
                    <p>
                        Data kegiatan
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        @if (Auth::user()->level_id == 1)
                        <a href="{{ url('rw/kegiatan') }}" class="nav-link {{ ($activeSubMenu == 'kegiatan_list')? 'active' : '' }}">
                        @elseif (Auth::user()->level_id == 2)
                        <a href="{{ url('rt/kegiatan') }}" class="nav-link {{ ($activeSubMenu == 'kegiatan_list')? 'active' : '' }}">
                        @elseif (Auth::user()->level_id == 3)
                        <a href="{{ url('warga/kegiatan') }}" class="nav-link {{ ($activeSubMenu == 'kegiatan_list')? 'active' : '' }}">
                        @endif
                            <i class="far nav-icon"></i>
                            <p>Daftar kegiatan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        @if (Auth::user()->level_id == 1)
                        <a href="{{ url('rw/dokumentasi') }}" class="nav-link {{ ($activeSubMenu == 'dokumentasi_list')? 'active' : '' }}">
                        @elseif (Auth::user()->level_id == 2)
                        <a href="{{ url('rt/dokumentasi') }}" class="nav-link {{ ($activeSubMenu == 'dokumentasi_list')? 'active' : '' }}">
                        @elseif (Auth::user()->level_id == 3)
                        <a href="{{ url('warga/dokumentasi') }}" class="nav-link {{ ($activeSubMenu == 'dokumentasi_list')? 'active' : '' }}">
                        @endif
                            <i class="far nav-icon"></i>
                            <p>Dokumentasi Kegiatan</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        @if (Auth::user()->level_id == 1)
                        <a href="{{ url('rw/iuran') }}" class="nav-link {{ ($activeSubMenu == 'iuran_list')? 'active' : '' }}">
                        @elseif (Auth::user()->level_id == 2)
                        <a href="{{ url('rt/iuran') }}" class="nav-link {{ ($activeSubMenu == 'iuran_list')? 'active' : '' }}">
                        @elseif (Auth::user()->level_id == 3)
                        <a href="{{ url('warga/iuran') }}" class="nav-link {{ ($activeSubMenu == 'iuran_list')? 'active' : '' }}">
                        @endif
                            <i class="far nav-icon"></i>
                            <p>Iuran Kegiatan</p>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
            @if(Auth::user()->level_id == 1 || Auth::user()->level_id == 2 || Auth::user()->level_id == 3 )
            <li class="nav-item">
                @if (Auth::user()->level_id == 1)
                <a href="{{ url('rw/keuangan') }}" class="nav-link {{ ($activeMenu == 'keuangan')? 'active' : '' }} ">
                @elseif (Auth::user()->level_id == 2)
                <a href="{{ url('rt/keuangan') }}" class="nav-link {{ ($activeMenu == 'keuangan')? 'active' : '' }} ">
                @elseif (Auth::user()->level_id == 3)
                <a href="{{ url('warga/keuangan') }}" class="nav-link {{ ($activeMenu == 'keuangan')? 'active' : '' }} ">
                @endif
                    <i class="nav-icon fas fa-cash-register"></i>
                    <p>Data Keuangan</p>
                </a>
            </li>
            @endif
            @if(Auth::user()->level_id == 1)
            <li class="nav-item">
                <a href="{{ url('rw/permintaan') }}" class="nav-link {{ ($activeMenu == 'permintaan')? 'active' : '' }} ">
                    <i class="nav-icon fas fa-envelope"></i>
                    <p>Permintaan</p>
                </a>
            </li>
            @endif
            @if(Auth::user()->level_id == 1 || Auth::user()->level_id == 2 || Auth::user()->level_id == 3 )
            <li class="nav-item">
                @if (Auth::user()->level_id == 1)
                <a href="{{ url('rw/keluargaku') }}" class="nav-link {{ ($activeMenu == 'keluargaku')? 'active' : '' }} ">
                @elseif (Auth::user()->level_id == 2)
                <a href="{{ url('rt/keluargaku') }}" class="nav-link {{ ($activeMenu == 'keluargaku')? 'active' : '' }} ">
                @elseif (Auth::user()->level_id == 3)
                <a href="{{ url('warga/keluargaku') }}" class="nav-link {{ ($activeMenu == 'keluargaku')? 'active' : '' }} ">
                @endif
                    <i class="nav-icon fas fa-users"></i>
                    <p>Keluargaku</p>
                </a>
            </li>
            <li class="nav-item">
                @if (Auth::user()->level_id == 1)
                <a href="{{ url('rw/profile') }}" class="nav-link {{ ($activeMenu == 'profile')? 'active' : '' }} ">
                @elseif (Auth::user()->level_id == 2)
                <a href="{{ url('rt/profile') }}" class="nav-link {{ ($activeMenu == 'profile')? 'active' : '' }} ">
                @elseif (Auth::user()->level_id == 3)
                <a href="{{ url('warga/profile') }}" class="nav-link {{ ($activeMenu == 'profile')? 'active' : '' }} ">
                @endif
                    <i class="nav-icon fas fa-user-circle"></i>
                    <p>Profil</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/logout') }}" class="nav-link {{ ($activeMenu == 'logout')? 'active' : '' }} ">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Keluar</p>
                </a>
            </li>
            @endif
        </ul>
    </nav>
  </div>
  