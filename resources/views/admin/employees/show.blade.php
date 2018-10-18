@extends('layouts.app')

@include('layouts.nav')

@section('content')

    <div class="container">
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-title text-center">Showing {{ $user->name }}</div>

                        <div class="card-body">
                            <strong>Email:</strong> {{ $user->email }}<br>
                            <strong>Telephone:</strong> {{ $user->profile->telephone }}<br>
                            <strong>Github Account:</strong> {{ $user->profile->github_account }}
                            <br>
                            <div style="padding-left: 50%;">
                                <a class="btn btn-success" href="{{ URL::to('admin/employees') }}">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection