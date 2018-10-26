@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top:45px;">
        <h1>EMPLOYEES</h1>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <a class="btn btn-primary" href="{{ route('admin.employees.create')}}"><i class="fa fa-plus"></i> Create new User</a>
        <br>
        <br>
        <table class="table">
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
                        <a class="btn btn-primary" href="{{ route('admin.employees.show', $user->id) }}"><i class="fa  fa-eye"></i> Show</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection