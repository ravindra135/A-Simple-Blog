@extends('layouts.blog-post');


@section('content')
    @if($post)
    <h1>{{ $post->title }}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{ $post->user->name }}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted on {{ $post->created_at->diffForHumans() }}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{ $post->photo ? $post->photo->file : 'https://picsum.photos/720/300' }}" alt="{{ $post->photo ? $post->photo->alt : 'blog-post' }}">

    <hr>

    <!-- Post Content -->
    <p class="lead">
        {{ $post->body }}
    </p>
    <hr>

    <div class="row">
        @if(\Illuminate\Support\Facades\Session::has('comment_submitted'))
            <div class="bg-success">
                <p><strong>{{ session('comment_submitted') }}</strong></p>
            </div>
        @elseif(\Illuminate\Support\Facades\Session::has('comment_unauthorized'))
            <div class="bg-danger">
                <p><strong>{{ session('comment_unauthorized') }}</strong></p>
            </div>
        @endif
    </div>

    <!-- Blog Comments -->
    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>
        {!! Form::open(['method'=>'post', 'action'=>'App\Http\Controllers\PostCommentsController@store']) !!}

            <div class="form-group">

                <input type="hidden" name="post_id" value="{{ $post->id }}">

                {!! Form::textarea('body', null, ['class'=>'form-control','rows'=>3]) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}
    </div>

    <hr>

        @if('comments')
            @foreach($comments as $comment)
                @if($comment->is_active == 1)
        <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img height='64' width="64" class="media-object img-circle" src="{{ $comment->profile_pic ? : 'https://i.pravatar.cc/64' }}" alt="avatar">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{ $comment->author }}
                            <small>{{ $comment->created_at->diffForHumans() }}</small>
                        </h4>
                        {{ $comment->body }}
                    <!-- Nested Comment -->
                        @if(count($comment->replies) > 0)
                            @foreach($comment->replies as $reply)
                                <div class="media">
                                    <a class="pull-left" href="#">
                                        <img height='48' width='48' class="media-object img-circle" src="{{ $reply->profile_pic }}" alt="">
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{ $reply->author }}
                                            <small>{{ $reply->created_at->diffForHumans() }}</small>
                                        </h4>
                                        {{ $reply->body }}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div style="margin-top: 1em">
                        {!! Form::open(['method'=>'post', 'action'=>'App\Http\Controllers\CommentRepliesController@reply']) !!}

                            <div class="form-group">
                               <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                {!! Form::textarea('body', null, ['class'=>'form-control','rows'=>3]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::submit('Submit', ['class'=>'btn btn-warning']) !!}
                            </div>

                        {!! Form::close() !!}
                        </div>
                        <!-- End Nested Comment -->
                    </div>
                </div>
                @endif
            @endforeach
        @endif

    @endif
@stop
