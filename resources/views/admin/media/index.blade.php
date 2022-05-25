@extends('layouts.admin')

@section('content')


    <h1 style="display:inline-block;margin-right:10px;" class="page-header">Media</h1>

    <a href="{{ route('media.create')}}">
        <button style="display:inline-block; float: right" class="btn btn-info" >
            <i class="fa fa-plus" aria-hidden="true"></i> Upload
        </button>
    </a>


    <div class="row">

        @if($photos)
        <ul>
            @foreach($photos as $photo)
                <li style="display:inline;">
                    <a href="{{ route('media.edit', $photo->id) }}">
                    <img style="padding: 0.5em; border-radius: 20px" height="200" width="200" src="{{ $photo->file }}" alt="server-images">
                    </a>
                </li>
            @endforeach
        </ul>
        @endif

    </div>

@stop
