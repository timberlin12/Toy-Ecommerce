@extends('backend.layouts.master')

@section('main-content')
<div class="card shadow mb-4">
    <div class="row">
        <div class="col-md-12">
            @include('backend.layouts.notification')
        </div>
    </div>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">Review Lists</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            @if(count($reviews) > 0)
            <table class="table table-bordered table-hover" id="review-dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Review By</th>
                        <th>Product</th>
                        <th>Review</th>
                        <th>Rate</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reviews as $review)
                    <tr>
                        <td>{{ $review->id }}</td>
                        <td>{{ $review->user_info['name'] }}</td>
                        <td>{{ $review->product ? $review->product->title : 'Product Not Found' }}</td>
                        <td>{{ $review->review }}</td>
                        <td>
                            <ul style="list-style:none; padding-left: 0;">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($review->rate >= $i)
                                        <li style="float:left; color:#F7941D;"><i class="fa fa-star"></i></li>
                                    @else
                                        <li style="float:left; color:#F7941D;"><i class="far fa-star"></i></li>
                                    @endif
                                @endfor
                            </ul>
                        </td>
                        <td>{{ $review->created_at->format('M d D, Y g:i a') }}</td>
                        <td>
                            @if($review->status == 'active')
                                <span class="badge badge-success">{{ $review->status }}</span>
                            @else
                                <span class="badge badge-warning">{{ $review->status }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('review.edit', $review->id) }}" class="btn btn-primary btn-sm mr-1" style="height:30px; width:30px; border-radius:50%" data-toggle="tooltip" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('review.destroy', $review->id) }}" class="d-inline">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm dltBtn" data-id="{{ $review->id }}" style="height:30px; width:30px; border-radius:50%" data-toggle="tooltip" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <h6 class="text-center">No reviews found!!!</h6>
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
    $('#review-dataTable').DataTable({
        "columnDefs": [
            { "orderable": false, "targets": [4, 7] } // Disable sorting on rating & action columns
        ]
    });

    $(document).ready(function () {
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        $('.dltBtn').click(function (e) {
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
