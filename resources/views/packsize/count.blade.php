@extends('layouts.master')
@section('active-count', 'active')
@section('title', 'Count Pack')
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Count Pack</h3>
          </div>
          <div class="card-body">
            <div class="row mb-3 justify-content-center align-items-center">
              <div class="col-3">
                <form action="{{ route('packsize.count') }}">
                  <div class="input-group input-group-md">
                    <input type="number" name="number" class="form-control" value="{{ request()->get('number') }}" placeholder="Input number" required>
                    <span class="input-group-append">
                      <button type="submit" class="btn btn-secondary btn-flat">Go!</button>
                    </span>
                  </div>
                </form>
              </div>
            </div>
            <div class="row">
              @foreach($totalPacks as $key => $val)
                <div class="col-sm-6 col-12">
                  <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fa fa-box-open"></i></span>
                    <div class="info-box-content">
                      <span class="info-box-text"><b>{{ $key }}</b> T-shirts</span>
                      <span class="info-box-number">{{ $val }} Packs to send</span>
                    </div>
                  </div>
                </div>    
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection