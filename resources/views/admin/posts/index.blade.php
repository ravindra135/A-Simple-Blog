@extends('layouts.admin')

@section('content')

    @if(\Illuminate\Support\Facades\Session::has('post_deleted'))

        <div class="alert alert-danger">
            <p><strong>{{ session('post_deleted') }}</strong></p>
        </div>

    @elseif(\Illuminate\Support\Facades\Session::has('post_created'))

        <div class="alert alert-success">
            <p><strong>{{ session('post_created') }}</strong></p>
        </div>

    @elseif(\Illuminate\Support\Facades\Session::has('post_created'))

        <div class="alert alert-info">
            <p><strong>{{ session('post_updated') }}</strong></p>
        </div>

    @endif

    <h1 class="page-header">Posts</h1>


    <div class="panel panel-default">
        <div class="panel-heading">
            All Posts
            <a href="{{ route('posts.create')}}">
                <button class="btn btn-info btn-xs pull-right" >
                    <i class="fa fa-plus" aria-hidden="true"></i> Create
                </button>
            </a>
{{--            <a style="text-decoration: none" href="{{ route('posts.create') }}">--}}
{{--                <button  class="btn btn-info btn-xs pull-right" >--}}
{{--                    <i class="fa fa-plus" aria-hidden="true"></i> Create--}}
{{--                </button>--}}
{{--            </a>--}}
        </div>
         <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Thumbnail</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Posted By</th>
                    <th scope="col">Post Views</th>
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
                        <td><img height="40px" src="{{ $post->photo ? $post->photo->file : $post->placeHolder() }}" alt="avatar"></td>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category ? $post->category->name : 'Uncategorized' }}</td>
                        <td>{{ $post->user->name }}</td>
                        <td>{{ $post->views }}</td>
                        <td>{{ $post->created_at->diffForHumans() }}</td>
                        <td>{{ $post->updated_at->diffForHumans() }}</td>
                        <td>
                            <a style="text-decoration: none;" href="{{ route('posts.edit', $post->id) }}">
                                <i class="fa fa-pencil fa-lg" style="color:red" aria-hidden="true"></i>
                            </a>
                            &nbsp;
                            <a style="text-decoration: none;" target="_blank" href="{{ route('post', $post->slug) }}">
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
    </div>
    {{-- For Pagination --}}
    {{--
    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {!! $posts->render() !!}
        </div>
    </div>
    --}}
@stop
