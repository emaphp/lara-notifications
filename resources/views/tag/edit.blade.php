@extends('layouts.app')
    @section('content')
    <div class="container" style="margin-top:45px;">
    <h1>Edit Tag</h1>
        <form action="{{ route('tags.update',  $tag->id) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group">
            <label for="name_tag">Name:</label>
            <input type="text" name="name_tag" id="name_tag" class="form-control" value="{{ $tag->name }}">
            </div>
            <p><button type="submit" class="btn btn-primary" />Save</button>
        </form>
    </div>
    @endsection