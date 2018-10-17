
@extends('layout')

<html>
    <head>
        <title>Create Tag - @yield('title')</title>
    </head>
    <body>
        @section('sidebar')
        <form action="" method="post">
            <p>Tag Name: <input type="text" name="name_tag" /></p>
            <p><input type="submit" /></p>
        </form>
      

        @show

        <div class="container">
            @yield('content')
        </div>
    </body>
</html>




