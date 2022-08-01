<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="{{ route('home.index') }}" class="nav-link">Home</a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#" style="padding-top: 7px">
        <img src="{{ session()->get('locale') == 'en' ? asset('logo/en.png') : asset('logo/id.png') }}" alt="User Avatar" class="" width="22">
      </a>
      <div class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
        <a href="{{ route('change.lang', ['lang'=>'en']) }}" class="dropdown-item">
          <div class="media">
            <img src="{{ asset('logo/en.png') }}" alt="User Avatar" class="mr-2" width="20">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                English
              </h3>
            </div>
          </div>
        </a>
        <div class="dropdown-divider"></div>
        <a href="{{ route('change.lang', ['lang'=>'id']) }}" class="dropdown-item">
          <div class="media">
            <img src="{{ asset('logo/id.png') }}" alt="User Avatar" class="mr-2" width="20">
            <div class="media-body">
              <h3 class="dropdown-item-title">
                Indonesia
              </h3>
            </div>
          </div>
        </a>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('logout') }}" role="button" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">
        <i class="fas fa-power-off"></i>
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
    </li>
  </ul>
</nav>