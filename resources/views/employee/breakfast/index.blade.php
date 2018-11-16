@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:45px;">
    <h1>BREAKFAST</h1>
    <div id="breakfast-list"></div>

    <div id="breakfast-historial"></div>

</div>
@endsection

@section('javascript')
    @parent
    <script src="{{ asset('js/breakfastList.js') }}"></script>
    <script src="{{ asset('js/breakfastHistorial.js') }}"></script>

@endsection