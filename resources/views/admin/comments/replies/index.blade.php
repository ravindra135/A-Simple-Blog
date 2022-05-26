@extends('layouts.admin')

@section('content')

    <h1 class="page-header">
        <span>
            <a style="text-decoration: none;" href="{{ route('comments.index') }}">
                <i style="color: hotpink" class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
        </span>Replies</h1>

    @if(count($comments->replies) > 0)
        <table class="table">
            <thead>
            <tr>
                <th></th>
                <th>Commented By</th>
                <th>Comment</th>
                <th>Time</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($comments->replies as $comment)
                <tr>
                    <td>
                        <img height='52' width="52" class="media-object img-circle" src="{{ $comment->profile_pic }}" alt="reply_avater">
                    </td>
                    <td>{{ $comment->author }}<br>{{ $comment->email }}</td>
                    <td>{{ $comment->body }}</td>
                    <td>{{ $comment->created_at->diffForHumans() }}</td>
                    <td>
                        @if($comment->is_active == 1 )
                            {!! Form::open(['method'=>'PATCH', 'action'=>['\App\Http\Controllers\CommentRepliesController@update', $comment->id]]) !!}

                            <input type="hidden" name="is_active" value='0'>

                            <div class="form-group">
                                {!! Form::submit('Un-Approve', ['class'=>'btn btn-success']) !!}
                            </div>
                            {!! Form::close() !!}

                        @else
                            {!! Form::open(['method'=>'PATCH', 'action'=>['\App\Http\Controllers\CommentRepliesController@update', $comment->id]]) !!}

                            <input type="hidden" name="is_active" value='1'>

                            <div class="form-group">
                                {!! Form::submit('Approve', ['class'=>'btn btn-info']) !!}
                            </div>
                            {!! Form::close() !!}

                        @endif
                    </td>
                    <td>
                        {!! Form::open(['method'=>'DELETE', 'action'=>['\App\Http\Controllers\CommentRepliesController@destroy', $comment->id]]) !!}
                        @csrf
                        <input type="hidden" name="is_active" value='1'>

                        <div class="form-group">
                            {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <h1 style="text-align: center"><strong>No Comments</strong></h1>
    @endif

@stop
