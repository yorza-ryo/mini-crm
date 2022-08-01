<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">@yield('title')</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          @isset($breadcrumb)
            @foreach($breadcrumb as $breadcrumb_label => $breadcrumb_link)
              @if($breadcrumb_label === array_key_last($breadcrumb))
                <li class="breadcrumb-item active">{{ $breadcrumb_label }}</li>
              @else
                <li class="breadcrumb-item"><a href="{{ $breadcrumb_link }}">{{ $breadcrumb_label }}</a></li>
              @endif
            @endforeach
          @endisset
        </ol>
      </div>
    </div>
  </div>
</div>