@extends('layouts.admin')

@section('content')

    @include('includes.tinyeditor')

    <h1 class="page-header">Create Post</h1>

    <div class="row">
        {!! Form::open(['method'=>'post', 'action'=>'App\Http\Controllers\AdminPostsController@store', 'files' => true]) !!}
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

        <div class="form-group">
            {!! Form::label('body', 'Body:') !!}
            {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Create Post', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

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
