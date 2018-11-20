@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top:45px;">
        <h1>BREAKFAST</h1>
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
        <div class="row" style="margin: 12px 0px;">
            <div class="col-3 text-center">
                <a class="Polaris-Button" href="{{ route('admin.breakfast.view_add_user')}}"><i class="fa fa-plus"></i> Add a User</a>
            </div>
            <div class="col-3 text-center">
                <a class="Polaris-Button" href="{{ route('admin.breakfast.view_remove_user')}}"><i class="fa fa-minus"></i> Remove a User</a>
            </div>
            <div class="col-3 text-center">
                <a class="Polaris-Button" href="{{ route('admin.breakfast.view_reassign_delegate')}}"><i class="fa fa-user-circle-o"></i> Reassign Delegate</a>
            </div>
            <div class="col-3 text-center">
                <a class="Polaris-Button" href="{{ route('admin.breakfast.postpone_delegate')}}"><i class="fa fa-user-circle"></i> Postpone Delagate</a>
            </div>

        </div>
        <div id="breakfast-list"></div>
    </div>
@endsection

@section('javascript')
    @parent
    <script src="{{ asset('js/breakfastList.js') }}"></script>
@endsection