@extends('layouts.app')

@include('layouts.nav')

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
                    <label for="startDate">Start Date:</label>
                    <input type="date" id="startDate" class="form-control" name="startDate">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="insertStartTime">Insert start time?</label>
                    <input type="checkbox" name="insertStartTime" id="insertStartTime" checked>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="startTime">Start Time:</label>
                    <input type="time" id="startTime" class="form-control" name="startTime">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="endDate">End Date:</label>
                    <input type="date" id="endDate" class="form-control" name="endDate">
                    @if ($errors->has('endDate'))
                        <div class="alert alert-danger">{{ $errors->first('endDate') }}</div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="insertEndTime">Insert end time?</label>
                    <input type="checkbox" name="insertEndTime" id="insertEndTime" checked>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="endTime">End Time:</label>
                    <input type="time" id="endTime" class="form-control" name="endTime">
                    @if ($errors->has('endTime'))
                        <div class="alert alert-danger">{{ $errors->first('endTime') }}</div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="place">Place:</label>
                    <input type="text" id="place" class="form-control" name="place">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" cols="30" rows="10"></textarea>
                </div>
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

@section('scripts')
    <script>
        window.addEventListener('DOMContentLoaded', function () {
            var chkStartTime = document.getElementById('insertStartTime');
            var startTime = document.getElementById('startTime');
            chkStartTime.addEventListener('click', function() {
                var checked = chkStartTime.checked;
                startTime.disabled=!checked;
            });
        });
        window.addEventListener('DOMContentLoaded', function () {
            var chkEndTime = document.getElementById('insertEndTime');
            var endTime = document.getElementById('endTime');
            chkEndTime.addEventListener('click', function() {
                var checked = chkEndTime.checked;
                endTime.disabled=!checked;
            });
        });
    </script>
@endsection