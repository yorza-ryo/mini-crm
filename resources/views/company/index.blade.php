@extends('layouts.master')
@section('active-company', 'active')
@section('title', 'Company')
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body table-responsive">
            <a href="#" type="button" data-toggle="modal" data-target="#modalCreate" class="btn btn-primary float-left"><i class="fa fa-plus-circle"></i> Create</a>
            <table class="datatables table table-bordered table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Logo</th>
                  <th>@lang('custom.table.name')</th>
                  <th>Email</th>
                  <th>@lang('custom.table.option')</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($employees as $employee)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                      <div class="product-img">
                        <img src="{{ asset('storage/'.$employee->logo) }}" alt="Product Image" class="img-size-50">
                      </div>
                    </td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>
                      <a href="#" class="btn btn-warning btn-sm edit-company" data-toggle="modal" data-target="#modalUpdate"
                        data-id="{{ $employee->id }}" data-name="{{ $employee->name }}" data-email="{{ $employee->email }}"
                        data-logo="{{ $employee->logo }}" data-pathlogo="{{ asset('storage/'.$employee->logo) }}">
                        <i class="fa fa-edit"></i>
                      </a>
                      <a href="#" class="btn btn-danger btn-sm delete-company" data-id="{{ $employee->id }}"><i class="fa fa-trash"></i></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
@section('modal')
<div class="modal fade" id="modalCreate" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create Company</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formCreateCompany" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="name" class="col-form-label">@lang('custom.table.name'):</label>
            <input type="text" name="name" class="form-control" id="name" >
          </div>
          <div class="form-group">
            <label for="email" class="col-form-label">Email:</label>
            <input type="email" name="email" class="form-control" id="email" >
          </div>
          <div class="form-group">
            <label for="logo" class="col-form-label">Logo:</label>
            <input type="file" name="logo" class="dropify" id="logo" data-allowed-file-extensions="jpg jpeg png" >
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalUpdate" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update Company</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formUpdateCompany" enctype="multipart/form-data">
        @csrf
        <div class="modal-body body-edit-company">
          <div class="form-group">
            <label for="name-update" class="col-form-label">@lang('custom.table.name'):</label>
            <input type="text" name="name" class="form-control" id="name-update" >
          </div>
          <div class="form-group">
            <label for="email-update" class="col-form-label">Email:</label>
            <input type="email" name="email" class="form-control" id="email-update" >
          </div>
          <div class="form-group">
            <label for="logo-update" class="col-form-label">Logo:</label>
            <input type="hidden" name="logo_old" id="logo_old">
            <input type="file" name="logo" class="edit-dropify" id="logo-update" data-allowed-file-extensions="jpg jpeg png" >
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('page-styles')
  <link rel="stylesheet" href="{{ asset('templates/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('templates/plugins/dropify/css/dropify.min.css') }}">
@endsection
@section('page-script')
  <script src="{{ asset('templates/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('templates/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('templates/plugins/dropify/js/dropify.min.js') }}"></script>
  <script>
    $('.dropify').dropify({
      messages: {
        'default': '<span style="font-size: 20px;">Drag and drop a file here or click</span>',
        'replace': '<span style="font-size: 20px;">Drag and drop or click to replace</span>',
        'remove':  'Remove',
        'error':   'Ooops, something wrong happended.'
      }
    });
    $(function () {
      $('.datatables').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });

    $(document).ready(function (e) {
      $('#formCreateCompany').on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
          url: "{{ route('company.store') }}",
          method: 'post',
          processData: false,
          contentType: false,
          data: new FormData(this),
          success: function (data) {
            if ($.isEmptyObject(data.errors)) {
              sessionStorage.setItem('toastrSuccess', data.success);
              location.reload();
            } else {
              $.each(data.errors, function (key, value) {
                toastr.error(value)
              });
            }
          }
        });
      }));
    });

    var id;
    $(document).on('click', ".edit-company", function () {
      id = $(this).data('id');
      var name = $(this).data('name');
      $('.modal-body #name-update').val(name);
      var email = $(this).data('email');
      $('.modal-body #email-update').val(email);
      var logo_old = $(this).data('logo');
      $('.modal-body #logo_old').val(logo_old);
      var logo = $(this).data('pathlogo');
      $('.edit-dropify').attr("data-default-file", logo);
      $('.edit-dropify').dropify();
    });
      
    $(document).on('submit', '#formUpdateCompany', (function (e) {
      var url = "{{ route('company.update', ':id') }}";
      e.preventDefault();
      $.ajax({
        url: url.replace(':id', id),
        method: 'post',
        processData: false,
        contentType: false,
        data: new FormData(this),
        success: function (data) {
          if ($.isEmptyObject(data.errors)) {
            sessionStorage.setItem('toastrSuccess', data.success);
            location.reload();
          } else {
            $.each(data.errors, function (key, value) {
              toastr.error(value)
            });
          }
        }
      });
    }));

    $(document).on('click', '.delete-company', function (e) {
      e.preventDefault();
      var id = $(this).data('id');
      var url = "{{ route('company.destroy', ':id') }}";
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: url.replace(':id', id),
            method: 'DELETE',
            error: function () {
              Swal.fire(
                'Error',
                'Your data has been deleted.',
                'error'
              )
            },
            success: function (data) {
              sessionStorage.setItem('toastrSuccess', 'Success.');
              location.reload();
            }
          });
        }
      })
    });
  </script>
@endsection