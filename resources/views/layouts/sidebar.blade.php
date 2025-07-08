<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
    <div class="sidebar-brand-icon">
    </div>
    <div class="sidebar-brand-text mx-3">Berita Acara Perkuliahan</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard') }}">
      <i class="fas fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('matakuliah.index') }}">
      <i class="fas fa-book"></i>
      <span>Mata Kuliah</span>
    </a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('jadwal.index') }}">
      <i class="fas fa-calendar-alt"></i>
      <span>Jadwal Perkuliahan</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('bap.index') }}">
      <i class="fas fa-file-alt"></i>
      <span>Berita Acara Perkuliahan</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="{{ route('profile') }}">
      <i class="fas fa-user"></i>
      <span>Profile</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="d-none d-md-inline text-center">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
