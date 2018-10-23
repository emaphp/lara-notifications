@extends('layouts.app')

@include('layouts.nav')

@section('content')
    <div class="container" style="margin-top:45px;">
        <h1>EVENTS</h1>
        <a class="btn btn-primary" href="{{ route('admin.events.create')}}"><i class="fa fa-plus"></i> Create new event</a>
        <br>
        <br>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>Start Date</th>
                <th>Start Time</th>
                <th>End Date</th>
                <th>End Time</th>
                <th>Place</th>
            </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                    <tr>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->start_date }}</td>
                        <td>{{ $event->start_time }}</td>
                        <td>{{ $event->end_date }}</td>
                        <td>{{ $event->end_time }}</td>
                        <td>{{ $event->place_id }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection