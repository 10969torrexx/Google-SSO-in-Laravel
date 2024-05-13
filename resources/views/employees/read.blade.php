@extends('layouts.app')
@section('title', 'Create departments | Human Resources Mangement System')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">{{ __('Register') }}</div>
                <div class="card-body">
                    @if (count($employees) <= 0)
                        <div class="alert alert-warning" role="alert">
                           No Employees added as of the moment.
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Department</th>
                            <th>Added</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @if ($employees)
                              @foreach ($employees as $item)
                                <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $item->name }}</td>
                                  <td>{{ $item->email }}</td>
                                  <td>{{ isset($departments[$item->department]) ? $departments[$item->department]['department_name'] : 'Not yet assigned' }}</td>
                                  <td>{{ date('Y-m-d', $item->created) }}</td>
                                  <td>
                                    <a type="button" data-id="{{ $item->id }}" id="edit" class="btn btn-primary btn-sm mr-2">Edit</a>
                                    <a type="button" data-id="{{ $item->id }}" id="delete" class="btn btn-danger btn-sm">Delete</a>
                                  </td>
                                </tr>
                              @endforeach 
                            @endif
                          <!-- Add more rows as needed -->
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow-sm">
            <div class="card-header" id="card_header">Update Employees</div>
            <div class="card-body">
              <form action="{{ route('editEmployees') }}" method="POST" id=""> @csrf
                <div class="form-group mb-2">
                  <label for="">Employee name</label>
                  <input type="text" value="" name="id" class="form-control d-none" id="department_id">
                  <p id="employee_name" class="text-left">-- no selected employee --</p>
                </div>
                <div class="form-group mb-2">
                  <label for="">Department</label>
                  <select name="department" id="department" class="form-control">
                    @foreach ($departments as $item)
                      <option value="{{ $item->id }}">{{ $item->department_name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary col-12" id="submit_btn" type="submit">
                    Update Employees
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>
</div>
<script>
  $(document).on('click', '#edit', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
    $.ajax({
        url: '{{ route("getEmployees") }}',
        method: 'POST',
        data: {
            id: id // Change 'email' to 'id'
        },
        success: function(response) {
          if (response.status == 200) {
            console.log(response.data[0]['name']);
            $('#department_id').val(response.data[0]['id']);
            $('#employee_name').text(response.data[0]['name']);
          }
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseJSON.message);
        }
    });
  });
  // Delete department
  $(document).on('click', '#delete', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });
    $.ajax({
        url: '{{ route("deleteEmployees") }}',
        method: 'POST',
        data: {
            id: id // Change 'email' to 'id'
        },
        success: function(response) {
          if (response.status == 200) {
           location.reload();
          }
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseJSON.message);
        }
    });
  });

</script>
@endsection
