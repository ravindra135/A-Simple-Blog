@extends('layouts.admin')

@section('styles')
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@stop



@section('content')

    <h1 class="page-header">Upload Multiple Media</h1>

    {!! Form::open(['method'=>'post', 'action'=>'App\Http\Controllers\AdminMediasController@store', 'class' => 'dropzone', 'files' => true]) !!}
    @csrf
@stop

@section('scripts')
    <script type="text/javascript" src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
@stop
