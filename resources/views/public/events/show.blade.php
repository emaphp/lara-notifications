@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top:20px;">
        <div id="event-description" slug="{{$slug}}"></div>
    </div>
@endsection

@section('javascript')
    @parent
    <script src="{{ asset('js/eventDescription.js') }}"></script>
@endsection