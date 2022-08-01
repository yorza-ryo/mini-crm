@extends('layouts.master')
@section('active-packsize', 'active')
@section('title', 'Pack Size')
@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Page Size</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body table-responsive">
            <a href="#" type="button" data-toggle="modal" data-target="#modalCreate" class="btn btn-primary float-left"><i class="fa fa-plus-circle"></i> Create</a>
            <table class="datatables table table-bordered table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Total</th>
                  <th>@lang('custom.table.option')</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($packSizes as $packSize)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $packSize->total }}</td>
                  <td>
                    <a href="#" class="btn btn-warning btn-sm edit-packsize" data-toggle="modal" data-target="#modalUpdate" data-id="{{ $packSize->id }}" data-total="{{ $packSize->total }}">
                      <i class="fa fa-edit"></i>
                    </a>
                    <a href="#" class="btn btn-danger btn-sm delete-packsize" data-id="{{ $packSize->id }}"><i class="fa fa-trash"></i></a>
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
        <h5 class="modal-title">Create Pack Size</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formCreatePackSize">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label for="total" class="col-form-label">Total:</label>
            <input type="number" name="total" class="form-control" id="total">
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
        <h5 class="modal-title">Update Pack Size</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="formUpdatePackSize">
        @csrf
        <div class="modal-body body-edit-packsize">
          <div class="form-group">
            <label for="total-update" class="col-form-label">Total:</label>
            <input type="number" name="total" class="form-control" id="total-update">
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

    $(document).ready(function (e) {
      $('#formCreatePackSize').on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
          url: "{{ route('packsize.store') }}",
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
    $(document).on('click', ".edit-packsize", function () {
      id = $(this).data('id');
      var total = $(this).data('total');
      $('.modal-body #total-update').val(total);
    });
      
    $(document).on('submit', '#formUpdatePackSize', (function (e) {
      var url = "{{ route('packsize.update', ':id') }}";
      e.preventDefault();
      $.ajax({
        url: url.replace(':id', id),
        method: 'patch',
        data: $('#formUpdatePackSize').serialize(),
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

    $(document).on('click', '.delete-packsize', function (e) {
      e.preventDefault();
      var id = $(this).data('id');
      var url = "{{ route('packsize.destroy', ':id') }}";
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