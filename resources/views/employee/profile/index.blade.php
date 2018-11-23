@extends('layouts.app')

@section('content')

    <div class="container" style="margin-top:45px;">
        <h1>PROFILE</h1>
        <div class="row">
            <div class="col-12">
                <strong>First Name:</strong> {{ $profile->first_name }}
            </div>
            <div class="col-12">
                <strong>Last Name:</strong> {{ $profile->last_name }}
            </div>
            <div class="col-12">
                <strong>Birthdate:</strong> {{ $profile->birthdate ? $profile->birthdate : "-"}}
            </div>
            <div class="col-12">
                <strong>Email:</strong> {{ $profile->user->email }}
            </div>
            <div class="col-12">
                <strong>Telephone:</strong> {{ $profile->telephone ? $profile->telephone : "-" }}
            </div>
            <div class="col-12">
                <strong>Github Account:</strong> {{ $profile->github_account ? $profile->github_account : "-" }}
            </div>
            <div class="col-12" style="margin-top: 20px;">
                <a class="Polaris-Button" href="{{ route('profile.edit', $profile->id) }}"><i class="fa fa-pencil"></i> Edit Profile</a>
            </div>
        </div>


    <div class = "row">
        
        <div class="col-6" id="file-picker" style="margin-top:20px;" user-id={{auth()->user()->id}}></div>
    </div>


    </div>


@endsection

@section('javascript')
    @parent
    <script src="//static.filestackapi.com/filestack-js/1.x.x/filestack.min.js"></script>
    <script src="{{ asset('js/filePicker.js') }}"></script>
@endsection