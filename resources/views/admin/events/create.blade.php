@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top:45px;">
        <h1>{{ __("Create Event") }}</h1>
        <form method="post" action="{{route('admin.events.store')}}">
            @csrf
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="name">Name:</label>
                    <input type="text" id="name" class="form-control" name="name" required>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="start_date">Start Date:</label>
                    <input type="date" id="start_date" class="form-control" name="start_date">
                    @if ($errors->has('start_date'))
                        <div class="alert alert-danger">{{ $errors->first('start_date') }}</div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="insert_start_time">Insert start time?</label>
                    <input type="checkbox" name="insert_start_time" id="insert_start_time" checked>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="start_time">Start Time:</label>
                    <input type="time" id="start_time" class="form-control" name="start_time">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="end_date">End Date:</label>
                    <input type="date" id="end_date" class="form-control" name="end_date">
                    @if ($errors->has('end_date'))
                        <div class="alert alert-danger">{{ $errors->first('end_date') }}</div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="insert_end_time">Insert end time?</label>
                    <input type="checkbox" name="insert_end_time" id="insert_end_time" checked>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="end_time">End Time:</label>
                    <input type="time" id="end_time" class="form-control" name="end_time">
                    @if ($errors->has('end_time') || $errors->has('endDateCheck') )
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="place">Place:</label>
                    <select name="place" id="place" class="form-control">
                        <option value="" >None</option>
                        @foreach($places as $place)
                            <option value="{{ $place->id}}" >{{ $place->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" cols="30" rows="10"></textarea>
                </div>
            </div>

            <div class="form-group">
                    <label for="event_tags">Tags:</label>
                    <select class="form-control taggables" name="event_tags[]" multiple="multiple" id="event_tags">
                    @foreach($tags as $tag)
                        <option value="{{ $tag->id }}"> {{ $tag->name }} </option>
                    @endforeach
                    </select>
            </div>

            <div class="row">
                <div class="form-group col-md-12" style="margin-top: 20px">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create Event</button>
                </div>
            </div>
        </form>

        <a class="btn btn-link" href="{{ route('admin.events.index') }}"><i class="fa fa-arrow-circle-left"></i> Back</a>
    </div>
@endsection

@section('javascript')
    @parent

    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            var chk_start_time = document.getElementById('insert_start_time');
            var start_time = document.getElementById('start_time');
            chk_start_time.addEventListener('click', function() {
                var checked = chk_start_time.checked;
                start_time.disabled=!checked;
            });
            var chk_end_time = document.getElementById('insert_end_time');
            var end_time = document.getElementById('end_time');
            chk_end_time.addEventListener('click', function() {
                var checked = chk_end_time.checked;
                end_time.disabled = !checked;
            });
        });
    </script>
<<<<<<< HEAD
    <script>
        $(document).ready(function() {
            $('#description').summernote();
            $('#guests').select2();
            $('.taggables').select2();
        });
    </script>
@endsection

@section('css')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection