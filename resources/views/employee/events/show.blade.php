@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top:45px;">
        <h1>Event detail</h1>
        <div class="row">
            <div class="col-12" style="margin-bottom: 7px;">
                <strong>Name:</strong> {{ $event->name }}
            </div>
            <div class="col-12">
                <strong>Description:</strong>
                <br>
                {!!$event->description !!}
            </div>
            <div class="col-12" style="margin-bottom: 7px;">
                <strong>Guests:</strong>
                @foreach($event->users()->get() as $guest)
                    <div>{{ $guest->name }}</div>
                @endforeach
            </div>
            <div class="col-12" style="margin-bottom: 7px;">
                <strong>Start Date:</strong> {{ $event->start_date }}
            </div>
            <div class="col-12" style="margin-bottom: 7px;">
                <strong>End Date:</strong> {{ $event->end_date }}
            </div>
            <div class="col-12" style="margin-bottom: 7px;">
                <strong>Status:</strong> {{ $event->status }}
            </div>
        </div>
        <a class="btn btn-link" href="{{ route('home') }}"><i class="fa fa-arrow-circle-left"></i> Back</a>
    </div>
@endsection