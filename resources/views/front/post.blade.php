@extends('layouts.home')

@section('title')
    <title>{{ $posts->title }}</title>
@endsection

@section('content')
<header class="masthead" style="background-image: url('{{ asset('storage/back/'.$posts->image)}}')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <h1>{{ $posts->title }}</h1>
                    <span class="meta">
                        Posted by
                        {{ $posts->User->name }}
                        on {{ \Carbon\Carbon::parse($posts->publish_date)->format('d F Y')  }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Post Content-->
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                {!! $posts->desc !!}
            </div>
        </div>
    </div>
</article>
@endsection