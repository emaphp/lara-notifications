@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:45px;">
    <h1>BREAKFAST</h1>
    <div id="breakfast-list"></div>
</div>
@endsection

@section('javascript')
    @parent
    <script src="{{ asset('js/breakfastList.js') }}"></script>
@endsection