@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top:45px;">
        <h1>EVENTS</h1>
        <a class="Polaris-Button" href="{{ route('admin.events.create')}}"><i class="fa fa-plus"></i> Create new event</a>
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
                <th>Status</th>
                <th></th>
                <th></th>
                <th></th>
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
                        <td>{{ $event->place ? $event->place->name : '' }}</td>
                        <td>{{ $event->status }}</td>
                        <td><a class="Polaris-Button" href="{{ route('admin.events.edit', $event->id) }}"><i class="fa fa-pencil"></i> Edit</a></td>
                        <td><a class="Polaris-Button" href="{{ route('admin.events.show', $event->id) }}"><i class="fa  fa-eye"></i> Show</a></td>
                        <td>
                            @if($event->published_at)
                                <form action="{{ route('admin.events.unpublish',  $event->id) }}" method="post">
                                @csrf
                                    <button type="submit" class="Polaris-Button"><i class="fa fa-undo"></i> Unpublish event</button>
                                </form>
                            @else
                                <form action="{{ route('admin.events.publish',  $event->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="Polaris-Button"><i class="fa fa-share"></i> Publish event</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection