@extends('layouts.app')

    @section('content')
    <div class="container" style="margin-top:45px;">
    <h1>Create Tag</h1>

        @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
        @endif

        <form action="{{ route('admin.tags.store')}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" class="form-control" required/>
            </div>
            <p><button type="submit" class="Polaris-Button" /><i class="fa fa-plus-circle"></i> Create</button>
        </form>

        <a class="btn btn-link" href="{{ route('admin.tags.index') }}"><i class="fa fa-arrow-circle-left"></i> Back</a> 
    </div>
    @endsection