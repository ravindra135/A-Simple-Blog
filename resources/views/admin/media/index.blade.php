@extends('layouts.admin')

@section('content')


    <h1 class="page-header">Media</h1>

    <a href="{{ route('media.create')}}">
        <button class="btn btn-info pull-right" >
            <i class="fa fa-plus" aria-hidden="true"></i> Upload
        </button>
    </a>

    <form action="delete/media" method="post">
        @csrf
        @method('DELETE')
        <div class="form-inline">
{{--            <div class="form-group">--}}
{{--                <select name="checkBoxArray" id="">--}}
{{--                    <option value="" class="form-control">Select</option>--}}
{{--                    <option value="delete" class="form-control">Delete</option>--}}
{{--                </select>--}}
{{--            </div>--}}
            <div class="form-group">
                <button id="selectedDelete" type="submit" class="btn btn-danger">Delete Selected</button>
            </div>
        </div>


        @if($photos)
        <table class="table">
            <thead>
                <tr>
                    <th><input type="checkbox" id="options"></th>
                    <th>Image</th>
                    <th>FileName</th>
                    <th>Action</th>
                </tr>
            </thead>
            @foreach($photos as $photo)
            <tbody>
                <tr>
                    <td>
                        <input type="checkbox" name="checkBoxArray[]" class="checkBoxes" value="{{ $photo->id }}">
                    </td>
                    <td>
                        <a href="{{ route('media.edit', $photo->id) }}">
                            <img style="padding: 0.5em; border-radius: 20px" height="120" width="120" src="{{ $photo->file }}" alt="server-images">
                        </a>
                    </td>
                    <td>{{ $photo->getAttributes()['file'] }}</td>
                    <td>
                        <input type="hidden" name="photo" value="{{ $photo->id }}">
                        <button type="submit" name="delete_single" value="delete" class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
        @endif

    </form>
{{--    <div class="row">--}}

{{--        @if($photos)--}}
{{--        <ul>--}}
{{--            @foreach($photos as $photo)--}}
{{--                <li style="display:inline;">--}}
{{--                    <input id="select" type="checkbox" style="display: none" value="{{ $photo->id }}">--}}
{{--                    <a href="{{ route('media.edit', $photo->id) }}">--}}
{{--                    <img style="padding: 0.5em; border-radius: 20px" height="200" width="200" src="{{ $photo->file }}" alt="server-images">--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--        @endif--}}

{{--    </div>--}}

@stop

@section('scripts')
    <script>
        $(document).ready(function (){

            $('#options').click(function (){

                if(this.checked) {
                    $('.checkBoxes').each(function(){
                        this.checked = true;
                    });
                } else {
                    $('.checkBoxes').each(function() {
                        this.checked = false;
                    });
                }
            });
        });
    </script>
@stop
