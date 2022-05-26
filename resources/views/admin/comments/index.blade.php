@extends('layouts.admin')

@section('content')

    <h1 class="page-header">Comments</h1>

    @if(count($comments) > 0)
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Commented By</th>
                <th>Comment</th>
                <th>Time</th>
                <th>Actions</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($comments as $comment)
            <tr>
                <td>{{ $comment->id }}</td>
                <td>{{ $comment->author }}<br>{{ $comment->email }}</td>
                <td>{{ $comment->body }}</td>
                <td>{{ $comment->created_at->diffForHumans() }}</td>
                <td>
                    <a href="{{ route('post', $comment->post->id ) }}"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                    <a href="{{ route('replies.show', $comment->id) }}">
                        <i class="fa fa-comment fa-lg" style="color:darkslategrey" aria-hidden="true"></i>
                    </a>
                </td>
                <td>
                    @if($comment->is_active == 1 )
                        {!! Form::open(['method'=>'PATCH', 'action'=>['\App\Http\Controllers\PostCommentsController@update', $comment->id]]) !!}

                        <input type="hidden" name="is_active" value='0'>

                        <div class="form-group">
                            {!! Form::submit('Un-Approve', ['class'=>'btn btn-success']) !!}
                        </div>
                        {!! Form::close() !!}

                    @else
                        {!! Form::open(['method'=>'PATCH', 'action'=>['\App\Http\Controllers\PostCommentsController@update', $comment->id]]) !!}

                        <input type="hidden" name="is_active" value='1'>

                        <div class="form-group">
                            {!! Form::submit('Approve', ['class'=>'btn btn-info']) !!}
                        </div>
                        {!! Form::close() !!}

                    @endif
                </td>
                <td>
                        {!! Form::open(['method'=>'DELETE', 'action'=>['\App\Http\Controllers\PostCommentsController@destroy', $comment->id]]) !!}
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
