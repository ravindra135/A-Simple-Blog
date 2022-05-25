@extends('layouts.admin')

@section('content')

    <h1 class="page-header">Edit Categories</h1>

    <div class="row">

        <div class="col-xs-6 col-lg-4">

            {!! Form::model($category, ['method'=>'PATCH', 'action'=>['App\Http\Controllers\AdminCategoriesController@update', $category->id]]) !!}
            @csrf

            <div class="form-group">
                {!! Form::label('name', 'Category : ') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Edit Category', ['class'=>'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}

        </div>

        <div class="col-xs-12 col-sm-6 col-lg-8">

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Created At</th>
                </tr>
                </thead>
                @if($categories)
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>{{ $category->created_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                @endif
            </table>

        </div>

    </div>

@stop
