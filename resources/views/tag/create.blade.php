@extends('layouts.app')

    @section('content')
    <div class="container" style="margin-top:45px;">
    <h1>Create Tag</h1>
        <form action="{{ route('tags.store')}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
            <label for="name_tag">Name:</label>
            <input type="text" name="name_tag" id="name_tag" class="form-control"/>
            </div>
            <p><button type="submit" class="btn btn-primary" />Create</button>
        </form>
    </div>
    @endsection