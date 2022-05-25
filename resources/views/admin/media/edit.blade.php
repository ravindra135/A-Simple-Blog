@extends('layouts.admin')

@section('content')

    <div style="">
        <div>
            <h1>Edit Media</h1>
        </div>
    </div>


    <div class="row">

        <div class="col-md-8">
            <img class="img-rounded" width="720" height="680"
                 src="{{ $photo->file }}" alt="{{ $photo->alt ? : 'laravel' }}">
        </div>

        <div class="col-md-4">

            {!! Form::model($photo, ['method'=>'PATCH', 'action'=> ['App\Http\Controllers\AdminMediasController@update', $photo->id], 'class'=>'form-horizontal']) !!}
            @csrf
            <fieldset disabled>
                <div class="form-group">
                    {!! Form::label('file', 'Name', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('file', $photo->getAttributes()['file'], ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('file_type', 'File&nbsp;Type', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('file_type', $photo->ext($photo->file), ['class'=>'form-control']) !!}
                    </div>
                </div>
            </fieldset>
                <div class="form-group">
                    {!! Form::label('alt', 'Alt', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('alt', $photo ? $photo->alt : null, ['class'=>'form-control']) !!}
                    </div>
                </div>
            <fieldset disabled>
                <div class="form-group">
                    {!! Form::label('size', 'Size', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('size', $photo->id, ['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('created_at', 'Created&nbsp;At', ['class'=>'col-sm-2 control-label']) !!}
                    <div class="col-sm-10">
                        {!! Form::text('created_at', $photo->created_at, ['class'=>'form-control']) !!}
                    </div>
                </div>
            </fieldset>
                <div class="form-group">
                    {!! Form::label('submit', '', ['class'=>'col-sm-2 control-label','style'=>'visibility:hidden']) !!}
                    <div class="col-sm-10">
                        {!! Form::submit('Update', ['class'=>'form-control btn btn-primary']) !!}
                    </div>
                </div>

            {!! Form::close() !!}

            {!! Form::open(['method'=>'POST', 'action'=> ['App\Http\Controllers\AdminMediasController@destroy', $photo->id], 'class'=>'form-horizontal']) !!}
            @csrf
            @method('DELETE')
                <div class="form-group">
                    {!! Form::label('submit', '', ['class'=>'col-sm-2 control-label','style'=>'visibility:hidden']) !!}
                        <div class="col-sm-10">
                            {!! Form::submit('Delete', ['class'=>'form-control btn btn-danger']) !!}
                        </div>
                </div>
            {!! Form::close() !!}
                {{--
                <form class="form-horizontal" method="patch" action="{{ route('media.update', $photo->id) }}">
                @csrf
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                        <input type="name" class="form-control" disabled id="name" value="{{ $photo->getAttributes()['file'] }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="filetype" class="col-sm-2 control-label">File&nbsp;Type</label>
                    <div class="col-sm-10">
                        <input type="name" class="form-control" disabled id="filetype" value="{{ $photo->getAttributes()['file'] }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="alt" class="col-sm-2 control-label">Alt</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="alt" value="{{ $photo->alt ? : null }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="size" class="col-sm-2 control-label">Size</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" disabled id="size" value="{{ $photo->id }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="created_at" class="col-sm-2 control-label">Created&nbsp;At</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" disabled id="created_at" value="{{ $photo->created_at }}">
                    </div>
                </div>
                <div class="form-group">
                    <label style="visibility: hidden" class="col-sm-2 control-label"></label>
                    <div class="col-sm-10">
                        <input type="submit" class="form-control btn btn-primary" value="Update">
                    </div>
                </div>
            </form>
            --}}
        </div>

    </div>
@stop
