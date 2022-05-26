@extends('layouts.admin')

@section('content')

    <h1 class="page-header">
        <span>
            <a style="text-decoration: none;" href="{{ route('users.index') }}">
                <i style="color: hotpink" class="fa fa-arrow-left" aria-hidden="true"></i>
            </a>
        </span>Edit User</h1>

    <div class="row">
        <div class="col-xs-6 col-lg-4">

            <img height="400" width="400" src="{{ $user->photo ? $user->photo->file : null }}" alt="avatar" class="img-rounded">

        </div>

        <div class="col-xs-12 col-sm-6 col-lg-8">

            {!! Form::model($user, ['method'=>'PATCH', 'action'=> ['App\Http\Controllers\AdminUsersController@update', $user->id], 'files' => true]) !!}
            @csrf

            <div class="form-group">
                {!! Form::label('name', 'Name : ') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('email', 'Email : ') !!}
                {!! Form::email('email', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('photo_id', 'Profile Picture : ') !!}
                {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('role_id', 'Role : ') !!}
                {!! Form::select('role_id',['' => 'Select Role'] + $roles, null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('is_active', 'Status : ') !!}
                {!! Form::select('is_active', array(1 => 'Active', 0 => 'Not Active'), null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('password', 'Password : ') !!}
                {!! Form::password('password', ['class'=>'form-control']) !!}
            </div>
            <div class="form-inline">
                <div class="form-group">

                        {!! Form::submit('Update User', ['class'=>'btn btn-primary']) !!}

                        {!! Form::close() !!}

                </div>

                <div class="form-group">

                        {!! Form::open(['method'=>'POST', 'action'=> ['App\Http\Controllers\AdminUsersController@destroy', $user->id]]) !!}
                        @csrf
                        @method('DELETE')

                        {!! Form::submit('Delete User', ['class'=>'btn btn-danger']) !!}

                        {!! Form::close() !!}

                </div>
            </div>

        </div>

    </div>

    <div class="row">
        @include('includes.form-errors')
    </div>
@endsection
