@extends('layouts.dashboard')

@section('title')
    <title>Posts</title>
@endsection

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.6/css/dataTables.bootstrap5.css">    
@endpush

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Posts</h1>
    </div>
    <div class="mt-3">
        <a href="{{ url('post/create') }}" class="btn btn-success mb-3">Add</a>
    </div>
    @if ($errors->any())
    <div class="my-3">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
    <div class="swal" data-swal="{{ session('success') }}"></div>
        <table style="width: 100%; overflow-x: auto;"  id="postTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">Title</th>
                    <th class="text-center">Author</th>
                    <th class="text-center">Image</th>
                    <th class="text-center">Views</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Publish Date</th>
                    <th></th>
                </tr>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $post->title }}</td>
                    <td class="text-center">{{ $post->User->name }}</td>
                    <td class="text-center">
                        <img style="max-width: 100px; max-height: 100px;" src="{{ asset('storage/back/'.$post->image) }}">
                    </td>
                    <td class="text-center">{{ $post->views }}</td>

                    @if ($post->status == 0)
                        <td class="text-center"><span class="badge bg-secondary">Private</span></td>
                    @else
                        <td class="text-center"><span class="badge bg-success">Published</span></td>
                    @endif

                    <td class="text-center">{{ $post->publish_date }}</td>
                    <td class="text-center">
                        <a href="{{ url("post/$post->id") }}" class="btn btn-primary">View</a>
                        <a href="{{ url("post/$post->id/edit") }}" class="btn btn-warning">Edit</a>
                        <a href="#" onclick="deletePost(this)" data-id="{{$post->id}}" class="btn btn-danger">Delete</a>
                    </td>
                    </tr>
                    @endforeach
                </tbody>
            </thead>
        </table>
    </div>
</main>
@endsection
@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.6/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.6/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const swal = $('.swal').data('swal');

        if(swal){
            Swal.fire({
                'title' : 'Success',
                'text'  : swal,
                'icon'  : 'success',
                'showConfirmButton' : false,
                'timer' : 1750
            })
        }

        function deletePost(e){
            let id = e.getAttribute('data-id');
            
            Swal.fire({
                'title' : 'Delete Post',
                'text'  : 'Do you want to delete this post ?',
                'icon'  : 'question',
                'showCancelButton' : true,
                'confirmButtonColor' : '#d33',
                'cancelButtonColor' : '#3085d6',
                'confirmButtonText' : 'Delete',
                'cancelButtonText' : 'Cancel'
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/post/' + id,
                    type: 'DELETE',
                    datatype:"json",
                    success: function(response) {
                        Swal.fire({
                            'title'   : 'Deleted!',
                            'text'    : response.message,
                            'icon'      :'success',
                        }).then(() => {
                           window.location.href = '/post';
                        });
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                       alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        });
        }
    </script>

    <script>
        new DataTable('#postTable', {
            responsive : true,
            scrollX: true,
        });
    </script>
@endpush