@extends('backend.layouts.master')

@section('main-content')
<div class="card shadow mb-4">
  <div class="row">
    <div class="col-md-12">
      @include('backend.layouts.notification')
    </div>
  </div>
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary float-left">Category Lists</h6>
    <a href="{{ route('category.create') }}" class="btn btn-primary btn-sm float-right" data-toggle="tooltip" title="Add Category">
      <i class="fas fa-plus"></i> Add Category
    </a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      @if(count($categories) > 0)
      <table class="table table-bordered table-hover" id="category-dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Is Parent</th>
            <th>Parent Category</th>
            <th>Photo</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($categories as $category)
          <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->title }}</td>
            <td>{{ $category->slug }}</td>
            <td>{{ $category->is_parent == 1 ? 'Yes' : 'No' }}</td>
            <td>{{ $category->parent_info->title ?? '' }}</td>
            <td>
              @if($category->photo)
              <img src="{{ $category->photo }}" class="img-fluid" style="max-width:80px" alt="{{ $category->title }}">
              @else
              <img src="{{ asset('backend/img/thumbnail-default.jpg') }}" class="img-fluid" style="max-width:80px" alt="default">
              @endif
            </td>
            <td>
              @if($category->status == 'active')
              <span class="badge badge-success">{{ $category->status }}</span>
              @else
              <span class="badge badge-warning">{{ $category->status }}</span>
              @endif
            </td>
            <td>
              <a href="{{ route('category.edit', $category->id) }}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px;width:30px;border-radius:50%" data-toggle="tooltip" title="Edit">
                <i class="fas fa-edit"></i>
              </a>
              <form method="POST" action="{{ route('category.destroy', $category->id) }}">
                @csrf
                @method('delete')
                <button class="btn btn-danger btn-sm dltBtn" data-id="{{ $category->id }}" style="height:30px;width:30px;border-radius:50%" data-toggle="tooltip" title="Delete">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
      <h6 class="text-center">No Categories found!!! Please create Category</h6>
      @endif
    </div>
  </div>
</div>
@endsection

@push('styles')
<link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
@endpush

@push('scripts')
<script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script>
  $('#category-dataTable').DataTable({
    "columnDefs": [{
      "orderable": false,
      "targets": [3, 4, 5, 6, 7]
    }]
  });

  $(document).ready(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('.dltBtn').click(function(e) {
      var form = $(this).closest('form');
      var dataID = $(this).data('id');
      e.preventDefault();
      swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this data!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          form.submit();
        } else {
          swal("Your data is safe!");
        }
      });
    });
  });
</script>
@endpush
