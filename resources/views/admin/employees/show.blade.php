@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header card-title text-center">Showing {{ $user->name }}</div>

                        <div class="card-body">
                            <strong>Email:</strong> {{ $user->email }}<br>
                            <strong>Telephone:</strong> {{ $user->profile ? $user->profile->telephone : "-" }}<br>
                            <strong>Github Account:</strong> {{ $user->profile ? $user->profile->github_account : "-" }}
                            <br>
                            <div style="padding-left: 50%;">
                                <a class="btn btn-success" href="{{ route('admin.employees.index') }}">Back</a>
                            </div>
                            @if (!($user->trashed()))
                                <form action="{{route('admin.employees.destroy', $user['id'])}}" method="post">
                                    <div style="text-align:right">
                                        @csrf
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button class="btn btn-danger" type="submit" >Disable User</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection