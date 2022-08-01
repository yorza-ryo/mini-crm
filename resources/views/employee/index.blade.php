@extends('layouts.master')
@section('active-employee', 'active')
@section('title', 'Employee')
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body table-responsive">
            <a href="{{ route('employee.create') }}" type="button" class="btn btn-primary float-left"><i class="fa fa-plus-circle"></i> Create</a>
            <table class="datatables table table-bordered table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>@lang('custom.table.company')</th>
                  <th>@lang('custom.table.first_name')</th>
                  <th>@lang('custom.table.last_name')</th>
                  <th>Email</th>
                  <th>@lang('custom.table.phone')</th>
                  <th>@lang('custom.table.option')</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($employees as $employee)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $employee->company->name }}</td>
                    <td>{{ $employee->first_name }}</td>
                    <td>{{ $employee->last_name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>{{ $employee->phone }}</td>
                    <td>
                      <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-warning btn-sm">
                        <i class="fa fa-edit"></i>
                      </a>
                      <a href="#" class="btn btn-danger btn-sm delete-employee" data-id="{{ $employee->id }}"><i class="fa fa-trash"></i></a>
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
@section('page-styles')
  <link rel="stylesheet" href="{{ asset('templates/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
@endsection
@section('page-script')
  <script src="{{ asset('templates/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('templates/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script>
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

    $(document).on('click', '.delete-employee', function (e) {
      e.preventDefault();
      var id = $(this).data('id');
      var url = "{{ route('employee.destroy', ':id') }}";
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