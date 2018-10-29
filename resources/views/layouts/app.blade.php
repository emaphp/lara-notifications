<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Ziggy Routes -->
    @routes

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('css')
</head>
<body>
    <div id="app">

        @include('layouts.nav')

        <div class="container-fluid" id="wrapper">
            <div class="row" style="min-height: 100%">
                @if(Auth::user())
                    @if(Auth::user()->type == 'admin')
                        @include('admin.nav_admin')
                    @elseif(Auth::user()->type == 'employee')
                        @include('employee.nav_employee')
                    @endif
                @endif

                <div class="col-md-10">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    @section('javascript')
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    @show

</body>
</html>
