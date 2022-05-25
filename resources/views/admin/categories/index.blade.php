@extends('layouts.admin')

@section('content')

    <h1 class="page-header">Add Categories</h1>

    <div class="row">

        <div class="col-xs-6 col-lg-4">

            {!! Form::open(['method'=>'post', 'action'=>'App\Http\Controllers\AdminCategoriesController@store']) !!}
            @csrf

            <div class="form-group">
                {!! Form::label('name', 'Category : ') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Add Category', ['class'=>'btn btn-primary']) !!}
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
{{--                        <th scope="col">No. of Posts</th>--}}
                        <th scope="col">Action</th>
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
{{--                        <td>{{ $category->post()->count() }}</td>--}}
                        <td>
                            <div class="form-inline">
                            <a href="{{ route('categories.edit', $category->id) }}">
                                <button class="btn btn-primary">Edit</button>
                            </a>
                                <div class="form-group">
                                {!! Form::open(['method'=>'POST', 'action'=> ['App\Http\Controllers\AdminCategoriesController@destroy', $category->id]]) !!}
                                @csrf
                                @method('DELETE')

                                {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}

                                {!! Form::close() !!}
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                @endif
            </table>

        </div>

    </div>

@stop
