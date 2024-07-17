
<!-- Sidebar Menu -->
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{ asset('adminlte') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SI</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('adminlte') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard" >
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('gudang') ? 'active' : '' }}" aria-current="page" href="/gudang">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Gudang
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('part') ? 'active' : '' }}" aria-current="page" href="/part">
              <i class="nav-icon fas fa-cubes"></i>
              <p>
                Product
              </p>
            </a>
          </li>

          <li class="nav-item">
          <div class="navbar-nav">
            <div class="nav-item text-nowrap">
              <form action="/logout" method="post">
                  @csrf
                <button type="submit" class="nav-link px-3 bg-dark border-0">Keluar <span data-feather="log-out"></span></button>
                </form>
            </div>
          </div>
          </li>


      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
