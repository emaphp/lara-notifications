@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top:45px;">
        <h1>NOTIFICATIONS</h1>
        <div id="unread-notifications" ></div>
    </div>
@endsection

@section('javascript')
    @parent
    <script src="{{ asset('js/unreadNotifications.js') }}" defer></script>
@endsection