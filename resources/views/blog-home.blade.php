@extends('layouts.blog-home')


@section('content')

    @if($posts)
        <h1 class="page-header">
            Blog Posts
            <small>Laravel Tutorial</small>
        </h1>

        @foreach($posts as $post)
        <!-- First Blog Post -->
        <h2>
            <a style="text-decoration: none; color: #1a202c" href="{{ route('post', $post->slug) }}">{{ $post->title }}</a>
        </h2>
        <p class="lead">
            by <a href="#">{{ $post->user->name }}</a>
        </p>
        <p><span class="glyphicon glyphicon-time"></span> Posted {{ $post->created_at->diffForHumans() }} |
            <i class="fa fa-eye" aria-hidden="true"></i> Post Views : {{ $post->views }}</p>
        <hr>
        <a style="text-decoration: none;" href="{{ route('post', $post->slug) }}">
            <img class="img-responsive" src="{{ $post->photo ? $post->photo->file : "https://picsum.photos/1280/720" }}" alt="{{ $post->photo ? $post->photo->alt : "blog_post_laravel" }}">
        </a>
        <hr>
        <p>{!! Str::limit($post->body, 25) !!}</p>
        <a class="btn btn-info" href="{{ route('post', $post->slug) }}">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

        <hr>
        @endforeach

    @endif

    <!-- Pager : Using Bootstrap Style -->
    <!-- Style 1 -->
{{--        <div style="text-align: center;">--}}
{{--        {{ $posts->links() }}--}}
{{--        </div>--}}

    <!-- Style 2 -->
        <ul class="pager">
            {{ $posts->links() }}
        </ul>

@stop
