@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>EMPLOYEES</h1>
        <hr>
        <a class="btn btn-primary" href="{{ route('admin.employees.create')}}"><i class="fa fa-plus"></i> Create new User</a>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <br>
        <br>

        <table class="table table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Email</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Estate</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->profile ? $user->profile->first_name : "-" }}</td>
                    <td>{{ $user->profile ? $user->profile->last_name : "-" }}</td>
                    <td>
                        @if ($user->trashed())
                            {{ __('Disabled') }}
                        @else
                            {{ __('Enabled') }}
                        @endif
                    </td>
                    <td>
                        <a class="btn btn-success" href="{{ route('admin.employees.show', $user->id) }}">View</a>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection