<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('mahasiswa.dashboard') }}">
    <div class="sidebar-brand-icon">
      {{-- <img src="{{ asset('admin_assets/img/bina-bangsa.jpeg') }}" alt="Bina Bangsa Logo" width="50"> --}}
    </div>
    <div class="sidebar-brand-text mx-3">Berita Acara Perkuliahan</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('mahasiswa.dashboard') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('mahasiswa.bap.index') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Berita Acara Perkuliahan</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('mahasiswa.profile') }}">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Profile</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="d-none d-md-inline text-center">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
