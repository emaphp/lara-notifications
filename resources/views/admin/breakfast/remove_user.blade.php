@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top:45px;">
        <h1>Remove User</h1>
        <hr>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('admin.breakfast.remove_user') }}" method="post">
            {{ csrf_field() }}

            <div class="row">
                <div class="form-group col-md-12">
                    <label for="removeTo">Remove to:</label>
                    <select name="removeTo" id="removeTo" class="form-control" required>
                        @if(!is_null($usersInQueue))
                            @foreach($usersInQueue as $user)
                                <option value="{{ $user->id}}" >{{ $user->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="form-group">
                <button class="Polaris-Button"><i class="fa fa-minus-circle"></i> Remove User</button>
            </div>
        </form>
        <a class="btn btn-link" href="{{ route('admin.breakfast.index') }}"><i class="fa fa-arrow-circle-left"></i> Back</a>
    </div>
@endsection