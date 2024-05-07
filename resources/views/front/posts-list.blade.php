@extends('layouts.home')

@section('title')
    <title>MyBook - Posts</title>
@endsection

@section('content')
        <header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
        </header>
        <!-- Main Content-->
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <!-- Post preview-->
                    @foreach ($latest_posts as $post)
                    <div class="post-preview">
                        <a href="{{ url('p/'.$post->slug) }}">
                            <div class="post-image">
                                <img style="max-width: 75%; max-height: 75%;" src="{{ asset('storage/back/'.$post->image) }}">
                            </div>
                            <div class="post-content">
                                <h2 class="post-title">{{ $post->title }}</h2>
                                <p class="post-subtitle">{{ Str::limit(strip_tags($post->desc), 200, '...') }}</p>
                            </div>
                        </a>
                        <p class="post-meta">
                            Posted by
                            <b>{{ $post->user->name }}</b>
                            on {{ \Carbon\Carbon::parse($post->publish_date)->format('d F Y')  }}
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                    @endforeach
                    
                    <!-- Pager-->
                    <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Other Posts →</a></div>
                </div>
            </div>
        </div>
@endsection