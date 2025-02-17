@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="justify-content-center">
            @if (Auth::user()->type == 'admin')
                <div id="employees-quantity"></div>
            @endif



            @if (Auth::user()->type == 'employee')
                <div id="pending-events"></div>
            @endif
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Home</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    @parent
    <script src="{{ asset('js/pendingEvents.js') }}" defer></script>
@endsection
