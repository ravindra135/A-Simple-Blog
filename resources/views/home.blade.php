@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h5 class="card-header d-flex justify-content-between align-items-center">
                  {{ __('Dashboard') }}
                  <a href="#">
                  <button type="button" class="btn btn-sm btn-primary">Button</button>
                  </a>
                </h5>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(Auth::check())
                        {{ __('You are logged in!') }}
                        @else
                        {{ __('You are Not logged in!') }}

                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
