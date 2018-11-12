@extends('layouts.app')

@section('content')
<div class="container" style="margin-top:45px;">
    <h1>Reassign Delegate</h1>
    <hr>
    <form action="{{ route('admin.breakfast.reassign_delegate') }}" method="post">
        {{ csrf_field() }}

        <div class="row">
            <div class="form-group col-md-12">
                <label for="delegate">Currently assigned to: <strong>{{ $delegate ? $delegate->name : '-' }}</strong></label>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <label for="newDelegate">Reassign to:</label>
                <select name="newDelegate" id="newDelegate" class="form-control" required>
                    @foreach($usersInQueue as $user)
                        @if($user != $delegate)
                            <option value="{{ $user->id}}" >{{ $user->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-primary"><i class="fa fa-pencil fa-fw"></i> Reassign</button>
        </div>
    </form>
    <a class="btn btn-link" href="{{ route('admin.breakfast.index') }}"><i class="fa fa-arrow-circle-left"></i> Back</a>
</div>
@endsection