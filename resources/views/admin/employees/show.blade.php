@extends('layouts.app')

@section('content')

    <div class="container" style="margin-top:45px;">
        <h1>Details of the employee {{ $user->name }}</h1>
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
                @if (!($user->trashed()))
                    <form action="{{route('admin.employees.destroy', $user->id)}}" method="post">
                        <div>
                            @csrf
                            <input name="_method" type="hidden" value="DELETE">
                            <button class="btn btn-danger" type="submit"><i class="fa fa-minus-circle"></i> Disable User</button>
                        </div>
                    </form>
                @endif
            </div>
            <div class="col-12">
                <a class="btn btn-link" href="{{ route('admin.employees.index') }}"><i class="fa fa-arrow-circle-left"></i> Back</a>
            </div>
        </div>
    </div>
@endsection