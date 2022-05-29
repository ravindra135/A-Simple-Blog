@extends('layouts.admin')

@section('content')
    @if(\Illuminate\Support\Facades\Session::has('user_deleted'))

        <div class="alert alert-danger">
            <p><strong>{{ session('user_deleted') }}</strong></p>
        </div>

        @elseif(\Illuminate\Support\Facades\Session::has('user_created'))

            <div class="alert alert-success">
                <p><strong>{{ session('user_created') }}</strong></p>
            </div>

        @elseif(\Illuminate\Support\Facades\Session::has('user_created'))

        <div class="alert alert-info">
            <p><strong>{{ session('user_updated') }}</strong></p>
        </div>

    @endif

    <h1 class="page-header">Users</h1>

    <div class="panel panel-default">
        <div class="panel-heading">
            All Users
            <a style="text-decoration: none" href="{{ route('posts.create') }}">
                <button  class="btn btn-info btn-xs pull-right" >
                    <i class="fa fa-plus" aria-hidden="true"></i> Create
                </button>
            </a>
        </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">Is Active</th>
                <th scope="col">Joined</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        @if($users)
        <tbody>
            @foreach($users as $user)
            <tr>

                <td>{{ $user->id }}</td>
                <td>
                    <img height="40" class="img-circle" width="40"
                         src="{{ $user->photo ? $user->photo->file : $user->defaultAvatar() }}"
                         alt="{{ $user->photo ? $user->photo->alt : 'avatar' }}">&nbsp;&nbsp;
                    <span><strong>{{ $user->name }}</strong></span>
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role ? $user->role->name : 'Guest' }}</td>
                <td>
                    {{ $user->is_active == 1 ? 'Active' : 'Inactive' }}
                </td>
                <td>{{ $user->created_at->diffForHumans() }}</td>
                <td>
                    <a style="text-decoration: none;" href="{{ route('users.edit', $user->id) }}">
                        <i class="fa fa-pencil fa-lg" style="color:red" aria-hidden="true"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
        @endif
    </table>
    </div>

@endsection

@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/@flasher/flasher/dist/flasher.min.js"></script>

@stop
