@extends('layouts.admin')

@section('content')

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
                        <td></td>
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
