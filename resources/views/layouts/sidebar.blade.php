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
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/warga') }}" class="nav-link {{ ($activeMenu == 'warga')? 'active' : '' }}">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Data Warga</p>
                </a>
            </li>
          
            <li class="nav-item">
                <a href="{{ url('/kegiatan') }}" class="nav-link {{ ($activeMenu == 'kegiatan')? 'active' : '' }} ">
                    <i class="nav-icon fas fa-list-alt"></i>
                    <p>Data Kegiatan</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/keuangan') }}" class="nav-link {{ ($activeMenu == 'keuangan')? 'active' : '' }} ">
                    <i class="nav-icon fas fa-cash-register"></i>
                    <p>Data Keuangan</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/profil') }}" class="nav-link {{ ($activeMenu == 'profil')? 'active' : '' }} ">
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
        </ul>
    </nav>
  </div>
  