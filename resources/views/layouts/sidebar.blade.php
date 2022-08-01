<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="index3.html" class="brand-link">
    <img src="{{ asset('templates/') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">MiniCRM</span>
  </a>
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-header">SOAL 01</li>
        <li class="nav-item">
          <a href="{{ route('home.index') }}" class="nav-link @yield('active-home')">
            <i class="nav-icon fas fa-home"></i>
            <p>Home</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('company.index') }}" class="nav-link @yield('active-company')">
            <i class="nav-icon fas fa-building"></i>
            <p>Company</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('employee.index') }}" class="nav-link @yield('active-employee')">
            <i class="nav-icon fas fa-users"></i>
            <p>Employee</p>
          </a>
        </li>
        <li class="nav-header">SOAL 02</li>
        <li class="nav-item">
          <a href="{{ route('packsize.index') }}" class="nav-link @yield('active-packsize')">
            <i class="nav-icon far fa-circle text-danger"></i>
            <p class="text">Page Size</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('packsize.count') }}" class="nav-link @yield('active-count')">
            <i class="nav-icon far fa-circle text-warning"></i>
            <p class="text">Count</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>