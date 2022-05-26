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

    <h1 class="page-header">Posts</h1>
         <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Thumbnail</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Posted By</th>
                    <th scope="col">Posted At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            @if($posts)
            <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td><img height="40px" src="{{ $post->photo ? $post->photo->file : 'https://placeimg.com/640/480/any' }}" alt="avatar"></td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category ? $post->category->name : 'Uncategorized' }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->created_at->diffForHumans() }}</td>
                        <td>{{ $post->updated_at->diffForHumans() }}</td>
                        <td>
                            <a style="text-decoration: none;" href="{{ route('posts.edit', $post->id) }}">
                                <i class="fa fa-pencil fa-lg" style="color:red" aria-hidden="true"></i>
                            </a>
                            &nbsp;
                            <a style="text-decoration: none;" href="{{ route('post', $post->id) }}">
                                <i class="fa fa-eye fa-lg" style="color:blue" aria-hidden="true"></i>
                            </a>
                            &nbsp;
                            <a style="text-decoration: none;" href="{{ route('comments.show', $post->id) }}">
                                <i class="fa fa-comment fa-lg" style="color:darkslategrey" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            @endif

        </table>
@stop
