<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('title','default')</title>
        <link rel="stylesheet" href={{asset("/css/app.css")}}>

    </head>
    <body>
        @yield('nav')
        <div class="container-fluid">
            <div class="row">
                @yield('nav-left')
                @yield('content')
            </div>
        </div>
        @yield('scripts')
    </body>
</html>