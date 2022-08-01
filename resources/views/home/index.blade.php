@extends('layouts.master')
@section('active-home', 'active')
@section('title', 'Home')
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-6">
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{ $company }}</h3>
            <p>@lang('custom.table.company')</p>
          </div>
          <div class="icon">
            <i class="fas fa-building"></i>
          </div>
          <a href="{{ route('company.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <div class="col-6">
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $employee }}</h3>
            <p>@lang('custom.employee')</p>
          </div>
          <div class="icon">
            <i class="fas fa-users"></i>
          </div>
          <a href="{{ route('employee.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection