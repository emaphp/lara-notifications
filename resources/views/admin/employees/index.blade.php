@extends('layouts.app')

@include('layouts.nav')

@section('content')
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-title text-center">Employees</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table class="table table-striped table-bordered">
                            <thead>
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
                </div>
            </div>
        </div>
    </div>
@endsection