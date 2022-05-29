@extends('layouts.admin')

@section('content')

    @include('includes.tinyeditor')

    <h1 class="page-header">
        <span>
            <a style="text-decoration: none;" href="{{ route('posts.index') }}">
                <i style="color: hotpink" class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
        </span>Edit Post</h1>

    <div class="row">
        {!! Form::model($post, ['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminPostsController@update', $post->id], 'files' => true]) !!}
        @csrf

        <div class="form-group">
            {!! Form::label('title', 'Title:') !!}
            {!! Form::text('title', null, ['class'=>'form-control', 'id' => 'title']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('slug', 'Slug:') !!}
            {!! Form::text('slug', null, ['class'=>'form-control', 'id' => 'slug']) !!}
        </div>

        <div class="form-inline">
            <div class="form-group">
                {!! Form::label('category_id', 'Category:') !!}
                {!! Form::select('category_id', [''=>'Select'] + $categories, null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('photo_id', 'Thumbnail :') !!}
                {!! Form::file('photo_id', ['class'=>'form-control']) !!}
            </div>
        </div>
{{--        If You Want To Show Post Image  --}}
{{--        <br>--}}
{{--        <div>--}}
{{--            <img height="480" width="720" src="{{ $post->photo->file }}" alt="" class="img-rounded">--}}
{{--        </div>--}}
{{--        <br>--}}
        <div class="form-group">
            {!! Form::label('body', 'Body:') !!}
            {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-inline">
            <div class="form-group">

                {!! Form::submit('Update Post', ['class'=>'btn btn-primary']) !!}
                {!! Form::close() !!}

            </div>

            <div class="form-group">

                {!! Form::open(['method'=>'POST', 'action'=> ['App\Http\Controllers\AdminPostsController@destroy', $post->id]]) !!}
                @csrf
                @method('DELETE')

                {!! Form::submit('Delete Post', ['class'=>'btn btn-danger']) !!}
                {!! Form::close() !!}
            </div>
        </div>

    </div>

    @include('includes.form-errors')

@stop

@section('scripts')

    <script>
        $('#title').keyup(function (e){
            $.get('{{ route('admin.posts.checkSlug') }}',
                {'title':$('#title').val()},
                function(data) {
                    $('#slug').val(data.slug);
                }
            );
        });
    </script>
@stop
