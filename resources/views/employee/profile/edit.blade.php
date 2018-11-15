@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top:45px;">
        <h1>Edit Profile</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('profile.update',  $profile->id) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $profile->first_name }}" required>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $profile->last_name }}" required>
            </div>
            <div class="form-group">
                <label for=birthdate">Birthdate:</label>
                <input type="date" id="birthdate" class="form-control" name="birthdate" value="{{ $profile->birthdate }}">
            </div>
            <div class="form-group">
                <label for="telephone">Telephone</label>
                <input type="tel" name="telephone" id="telephone" class="form-control" placeholder="+dd (ddd) ddd-dddd" value="{{ $profile->telephone }}">
            </div>
            <div class="form-group">
                <label for="github_account">Github Account:</label>
                <input type="text" name="github_account" id="github_account" class="form-control" value="{{ $profile->github_account }}">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ $profile->user->email }}" required>
            </div>
            <div class="form-group">
                <label for="birthdate">Birthdate:</label>
                <input type="date" name="birthdate" id="birthdate" class="form-control" value="{{ $profile->birthdate }}" required>
            </div>
            <div style="margin-top: 20px;">
                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </form>
        <div class="row">
            <div class="col-lg-12" style="margin-top: 20px;">
                <a class="btn btn-link" href="{{ route('profile.index') }}"><i class="fa fa-arrow-circle-left"></i> Back</a>
            </div>
        </div>
    </div>
@endsection