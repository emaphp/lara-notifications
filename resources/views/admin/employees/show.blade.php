@extends('layouts.app')

@section('content')

    <div class="container" style="margin-top:45px;">
        <h1>Details of the employee {{ $user->name }}</h1>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="row">
            <div class="col-12">
                <strong>Email:</strong> {{ $user->email }}
            </div>
            <div class="col-12">
                <strong>Telephone:</strong> {{ $user->profile ? $user->profile->telephone : "-" }}
            </div>
            <div class="col-12">
                <strong>Github Account:</strong> {{ $user->profile ? $user->profile->github_account : "-" }}
            </div>
            <div class="col-12">
                <strong>Birthdate:</strong> {{ $user->profile ? $user->profile->birthdate : "-" }}
            </div>
            @if (!($user->trashed()))
                <div class="col-6">
                    <form action="{{route('admin.employees.destroy', $user->id)}}" method="post">
                        <div>
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="Polaris-Button danger" type="submit"><i class="fa fa-minus-circle"></i> Disable User</button>
                        </div>
                    </form>
                </div>
                <div class="col-6">
                    <a class="Polaris-Button" href="{{ route('admin.employees.edit', $user->id) }}"><i class="fa fa-pencil"></i> Edit User</a>
                </div>
            @else
                <div class="col-6">
                    <form action="{{route('admin.employees.enable', $user->id )}}" method="post">
                        <div>
                            @csrf
                            <button class="Polaris-Button" type="submit"><i class="fa fa-plus-circle"></i> Enable User</button>
                        </div>
                    </form>
                </div>
            @endif
         
        </div>

        <div class="row">
            <div class="col-12">
                <a class="Polaris-Button Polaris-Button--plain" href="{{ route('admin.employees.index') }}"><i class="fa fa-arrow-circle-left"></i> Back</a>
            </div>
        </div>
    </div>
@endsection