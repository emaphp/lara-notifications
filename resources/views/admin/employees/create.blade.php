@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top:45px;">
        <h1>Create User</h1>
        <hr>

        <form action="{{ route('admin.employees.store') }}" method="post">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" name="first_name" id="first_name" class="form-control {{ $errors->has('firts_name') ? ' is-invalid' : '' }}" value="{{ old('first_name') }}" required>
                @if ($errors->has('first_name'))
                    <span class="text-danger" role="alert">
                        <strong>{{ $errors->first('first_name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" name="last_name" id="last_name" class="form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" value="{{ old('last_name') }}" required>
                @if ($errors->has('last_name'))
                    <span class="text-danger" role="alert">
                        <strong>{{ $errors->first('last_name') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                    <span class="text-danger" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="github">Github:</label>
                <input type="text" name="github" id="github" class="form-control" value="{{ old('github') }}">
            </div>

            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" name="phone" id="phone" class="form-control" placeholder="+dd (ddd) ddd-dddd" value="{{ old('phone') }}">
                @if ($errors->has('phone'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <label for="birthdate">Birthdate:</label>
                <input type="date" name="birthdate" id="birthdate" class="form-control" value="{{ old('birthdate') }}">
                @if ($errors->has('birthdate'))
                    <span class="text-danger" role="alert">
                        <strong>{{ $errors->first('birthdate') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group">
                <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Create</button>
            </div>
        </form>

        <a class="btn btn-link" href="{{ route('admin.employees.index') }}"><i class="fa fa-arrow-circle-left"></i> Back</a>

    </div>
@endsection