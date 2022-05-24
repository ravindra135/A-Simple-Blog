@extends('layouts.admin')

@section('content')

    <div class="container">
    @if(\Illuminate\Support\Facades\Session::has('post_deleted'))

        <div class="bg-danger">
            <p><strong>{{ session('post_deleted') }}</strong></p>
        </div>

    @elseif(\Illuminate\Support\Facades\Session::has('post_created'))

        <div class="bg-success">
            <p><strong>{{ session('post_created') }}</strong></p>
        </div>

    @elseif(\Illuminate\Support\Facades\Session::has('post_created'))

        <div class="bg-info">
            <p><strong>{{ session('post_updated') }}</strong></p>
        </div>

    @endif
    </div>

    <h1>Posts</h1>
         <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Thumbnail</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Posted By</th>
                    <th scope="col">Posted At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            @if($posts)
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td><img height="35px" class="rounded-circle" src="{{ $post->photo->file }}" alt="avatar"></td>
                        <td>{{ $post->title }}</td>
                        <td></td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="{{ route('posts.edit', $post->id) }}">
                                <button class="btn btn-primary">Edit</button>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            @endif

        </table>
@stop
