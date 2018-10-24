@extends('layouts.app')

@include('layouts.nav')

@section('content')
    <div class="container" style="margin-top:45px;">
        <h1>Edit Event</h1>
        <form action="{{ route('admin.events.update',  $event->id) }}" method="post">
            @csrf
            <input name="_method" type="hidden" value="PATCH">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $event->name }}" required>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $event->start_date }}">
                @if ($errors->has('start_date'))
                    <div class="alert alert-danger">{{ $errors->first('start_date') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="insert_start_time">Insert start time?</label>
                <input type="checkbox" name="insert_start_time" id="insert_start_time" checked>
            </div>
            <div class="form-group">
                <label for="start_time">Start Time:</label>
                <input type="time" name="start_time" id="start_time" class="form-control" value="{{ $event->start_time }}">
            </div>
            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $event->end_date }}">
                @if ($errors->has('end_date'))
                    <div class="alert alert-danger">{{ $errors->first('end_date') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="insert_end_time">Insert end time?</label>
                <input type="checkbox" name="insert_end_time" id="insert_end_time" checked>
            </div>
            <div class="form-group">
                <label for="end_time">End Time:</label>
                <input type="time" name="end_time" id="end_time" class="form-control" value="{{ $event->end_time }}">
                @if ($errors->has('end_time'))
                    <div class="alert alert-danger">{{ $errors->first('end_time') }}</div>
                @endif
            </div>
            <div class="form-group">
                <label for="place">Place:</label>
                <input type="text" name="place" id="place" class="form-control" value="{{ $event->place_id }}">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" cols="30" rows="10">{{ $event->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="guests">Guests:</label>
                <select id="guests" name="guests[]" multiple="multiple" style="width:100%">
                    {{ $guests = $event->users }}
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ $guests->contains('id',$user->id) ? 'selected' : ''}}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" style="margin-top: 20px">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
        <a class="btn btn-link" href="{{ route('admin.events.index') }}"><i class="fa fa-arrow-circle-left"></i> Back</a>
    </div>
@endsection



@section('scripts')
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
@endsection