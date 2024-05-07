@extends('layouts.dashboard')

@section('title')
    <title>Dashboard</title>
@endsection

@section('content')
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
      </div>

      <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
          <h1 class="display-5 fw-bold text-center">Hello, {{ auth()->user()->name }} !</h1>
        </div>
      </div>

      <div class="row text-center">
        <div class="col-6">
          <div class="card text-white mb-3" style="max-width: 100%;">
            <div class="card-header bg-success">Total Posts</div>
            <div class="card-body">
              <h5 class="card-title text-black">{{ $total_posts}} posts</h5>
            </div>
          </div>
        </div>

        <div class="col-6">
          <div class="card text-white mb-3" style="max-width: 100%;">
            <div class="card-header bg-primary">Total Views</div>
            <div class="card-body">
              <h5 class="card-title text-black">{{ $total_views}} views</h5>
            </div>
          </div>
        </div>
      </div>

      <div class="row text-center">
        <div class="col-6">
          <h4>Latest Posts</h4>
          <div class="table-container" style="overflow-y: auto;
          overflow-x: auto;">
          <table class="table table-bordered table-striped" >
          <thead>
            <tr>
              <th>No.</th>
              <th>Title</th>
              <th>Author</th>
              <th>Created At</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($latest_posts as $post)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->User->name}}</td>
                <td>{{$post->created_at->format('d M Y')}}</td>
                <td><a href="{{ url("post/$post->id") }}" class="btn btn-primary">View</a></td>
              </tr>
            @endforeach
          </tbody>      
        </table>
        </div>
        </div>

        <div class="col-6">
          <h4>Popular Posts</h4>
          <div class="table-container" style="overflow-y: auto;
          overflow-x: auto;">
          <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>No.</th>
              <th>Title</th>
              <th>Author</th>
              <th>Views</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($popular_posts as $post)
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->User->name}}</td>
                <td>{{$post->views}}</td>
                <td><a href="{{ url("post/$post->id") }}" class="btn btn-primary">View</a></td>
              </tr>
            @endforeach
          </tbody>      
        </table>
        </div>
        </div>
      </div>

      </div>
    </main>
  </div>
</div>
@endsection