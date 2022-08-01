<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  @yield('meta')  
  <title>Mini-CRM</title>

  @stack('before-styles')
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('templates/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{ asset('templates/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('templates/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="{{ asset('templates/plugins/toastr/toastr.min.css') }}">
  @stack('after-styles')


  @if (trim($__env->yieldContent('page-styles')))
    @yield('page-styles')
  @endif
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    @include('layouts.navbar')
    @include('layouts.sidebar')
    <div class="content-wrapper">
      @isset($breadcrumb)
        @include('layouts.breadcrumb')
      @endisset
      @yield('content')
    </div>
    @include('layouts.footer')
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
    {{-- modal dialog --}}
    @yield('modal')
  </div>

  @stack('before-scripts')
  <script src="{{ asset('templates/plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('templates/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('templates/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <script src="{{ asset('templates/dist/js/adminlte.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="{{ asset('js/custom.js') }}"></script>
  @stack('after-scripts')

  {{-- page Scripts --}}
  @yield('page-script')
  @stack('page-scripts')

  <script src="{{ asset('templates/plugins/toastr/toastr.js') }}"></script>
  {!! Toastr::message() !!}
</body>

</html>