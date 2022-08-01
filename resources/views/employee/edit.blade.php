@extends('layouts.master')
@section('active-employee', 'active')
@section('title', 'Employee')
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Update Employee</h3>
          </div>
          <form method="post" action="{{ route('employee.update', $employee->id) }}">
            @csrf
            @method('put')
            <div class="card-body">
              <div class="form-group row">
                <label for="company" class="col-sm-2 col-form-label">@lang('custom.table.company')</label>
                <div class="col-sm-10">
                  <select name="company_id" id="company" class="form-control select2 @error('company_id') is-invalid @enderror" style="width: 100%">
                    <option value="" selected disabled>Company</option>
                    @foreach ($companies as $company)
                      <option value="{{ $company->id }}" {{ (old('company_id') ?? $employee->company_id) == $company->id ? 'selected' : '' }}>{{ $company->name }}</option>
                    @endforeach
                  </select>
                  @error('company_id') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="first-name" class="col-sm-2 col-form-label">@lang('custom.table.first_name')</label>
                <div class="col-sm-10">
                  <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{ old('first_name') ?? $employee->first_name }}" id="first-name" placeholder="First Name">
                  @error('first_name') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="last-name" class="col-sm-2 col-form-label">@lang('custom.table.last_name')</label>
                <div class="col-sm-10">
                  <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{ old('last_name') ?? $employee->last_name }}" id="last-name" placeholder="Last Name">
                  @error('last_name') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') ?? $employee->email }}" id="email" placeholder="Email">
                  @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="phone" class="col-sm-2 col-form-label">@lang('custom.table.phone')</label>
                <div class="col-sm-10">
                  <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') ?? $employee->phone }}" id="phone" placeholder="Phone">
                  @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
                </div>
              </div>
            </div>
            <div class="card-footer">
              <a href="{{ route('employee.index') }}" type="a" class="btn btn-default">Cancel</a>
              <button type="submit" class="btn btn-info float-right">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
@section('page-styles')
  <link rel="stylesheet" href="{{ asset('templates/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('templates/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('page-script')
  <script src="{{ asset('templates/plugins/select2/js/select2.full.min.js') }}"></script>
  <script>
    $('.select2').select2({
      theme: 'bootstrap4'
    });
  </script>
@endsection