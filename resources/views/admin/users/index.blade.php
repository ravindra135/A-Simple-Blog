@extends('layouts.admin')

@section('content')

    @if(\Illuminate\Support\Facades\Session::has('user_deleted'))

        <div class="bg-danger">
            <p><strong>{{ session('user_deleted') }}</strong></p>
        </div>

        @elseif(\Illuminate\Support\Facades\Session::has('user_created'))

            <div class="bg-success">
                <p><strong>{{ session('user_created') }}</strong></p>
            </div>

        @elseif(\Illuminate\Support\Facades\Session::has('user_created'))

        <div class="bg-info">
            <p><strong>{{ session('user_updated') }}</strong></p>
        </div>

    @endif

    <h1>Users</h1>

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
                    <img height="35px" class="rounded-circle" src="{{ $user->photo->file }}" alt="avatar">&nbsp;&nbsp;{{ $user->name }}
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name }}</td>
                <td>
                    {{ $user->is_active == 1 ? 'Active' : 'Inactive' }}
                </td>
                <td>{{ $user->created_at->diffForHumans() }}</td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}">
                        <button class="btn btn-primary">Edit</button>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
        @endif
    </table>

@endsection
