@extends('layouts.dashboard')

@section('title')
    <title>Create Post</title>
@endsection

@section('content')

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create Post</h1>
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

    <form action="{{ url('post')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-6">
                <div class="mb-6">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="desc">Description</label>
            <textarea name="desc" id="desc" cols="30" rows="10" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label for="image">Image (Max 3MB)</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="" hidden>-- Choose --</option>
                        <option value="1">Publish</option>
                        <option value="0">Private</option>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="status">Publish Date</label>
                    <input type="date" name="publish_date" id="publish_date" class="form-control">
                </div>
            </div>
        </div>
        <div class="float-end">
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    </form>

@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script>
        var options  = {
            filebrowserImageBrowserUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token=',
            clipboard_handleImages: false
            
        }
    </script>
    <script>
        CKEDITOR.replace('desc', options);
    </script>
@endpush