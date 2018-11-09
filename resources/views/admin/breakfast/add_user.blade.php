@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top:45px;">
        <h1>Add User to Breakfast List</h1>
        <hr>
        <form action="{{ route('admin.breakfast.add_user') }}" method="post">
            {{ csrf_field() }}

            <div class="row">
                <div class="form-group col-md-12">
                    <label for="addTo">Add to:</label>
                    <select name="addTo" id="addTo" class="form-control" required>
                        @if(!is_null($users))
                            @foreach($users as $user)
                                <option value="{{ $user->id}}" >{{ $user->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-12">
                    <label for="before">Before:</label>
                    <select name="before" id="before" class="form-control">
                        @foreach($usersInQueue as $userInQueue)
                            @if($userInQueue == $lastDelegate)
                                <option value="{{ $userInQueue->id}}" selected>{{ $userInQueue->name }}</option>
                            @else
                                <option value="{{ $userInQueue->id}}" >{{ $userInQueue->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add User</button>
            </div>
        </form>
        <a class="btn btn-link" href="{{ route('admin.breakfast.index') }}"><i class="fa fa-arrow-circle-left"></i> Back</a>
    </div>
@endsection