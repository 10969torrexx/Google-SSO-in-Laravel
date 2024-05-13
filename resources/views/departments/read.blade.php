@extends('layouts.app')
@section('title', 'Create departments | Human Resources Mangement System')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header">{{ __('Register') }}</div>
                <div class="card-body">
                    @if (count($departments) <= 0)
                        <div class="alert alert-warning" role="alert">
                           No Department added as of the moment.
                        </div>
                    @endif
                    <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Departmant Name</th>
                            <th>Created</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @if ($departments)
                              @foreach ($departments as $item)
                                <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $item->department_name }}</td>
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
            <div class="card-header" id="card_header">Add Departments</div>
            <div class="card-body">
              <form action="{{ route('addDepartments') }}" method="POST" id="department_form"> @csrf
                <div class="form-group mb-2">
                  <label for="">Department name</label>
                  <input type="text" value="" name="id" class="form-control d-none" id="department_id">
                  <input id="department_name" type="text" class="form-control @error('department_name') is-invalid @enderror" name="department_name" value="{{ old('department_name') }}" required autocomplete="email">
                    @error('department_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                  <button class="btn btn-primary col-12" id="submit_btn" type="submit">
                    Add Department
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
        url: '{{ route("getDepartments") }}',
        method: 'POST',
        data: {
            id: id // Change 'email' to 'id'
        },
        success: function(response) {
          if (response.status == 200) {
            console.log(response.data[0]['department_name']);
            $("#department_form").attr("action", `{{ route("editDepartments") }}`);
            $('#submit_btn').text('Edit Department');
            $('#card_header').text('Edit Department');
            $('#department_id').val(response.data[0]['id']);
            $('#department_name').val(response.data[0]['department_name']);
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
        url: '{{ route("deleteDepartments") }}',
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
