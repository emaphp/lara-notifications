@extends('layouts.app')

    @section('content')
    <div class="container" style="margin-top:45px;">
    <h1>Create Place</h1>
        <form action="{{ route('admin.places.store')}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="place_name">Name:</label>
                <input type="text" name="place_name" id="place_name" class="form-control" required/>
                <label for="place_description">Description:</label>
                <input type="text" name="place_description" id="place_description" class="form-control" required/>
                <label for="place_type">Type:</label>
                <select name="place_type" id="place_type" class="form-control" required>
                @foreach($array_type as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
                </select>

                <div class="form-group">
                    <label for="place_tags">Tags:</label>
                    <select class="form-control taggables" name="place_tags[]" multiple="multiple" id="place_tags">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}"> {{ $tag->name }} </option>
                    @endforeach
                    </select>
                </div>

            </div>
            <p><button type="submit" class="btn btn-primary" /><i class="fa fa-plus-circle"></i> Create</button>
        </form>

        <a class="btn btn-link" href="{{ route('admin.places.index') }}"><i class="fa fa-arrow-circle-left"></i> Back</a> 
    </div>
    @endsection

@section('javascript')
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.taggables').select2();
        });
    </script>
@endsection

@section('css')
    @parent
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection