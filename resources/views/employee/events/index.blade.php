@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top:45px;">
        <h1>EVENTS</h1>
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
                    <td>{{ $event->place ? $event->place->name : 'None' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
@endsection