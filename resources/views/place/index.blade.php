@extends('layouts.app')

@section('content')

    <div class="container" style="margin-top:45px;">
        <h1>PLACES</h1>
        <a class="Polaris-Button" href="{{ route('admin.places.create')}}"><i class="fa fa-plus"></i> Create new place</a>
        <br>
        <br>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
    


    <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col"> Name</th>
            <th scope="col">Description</th>
            <th scope="col">Type</th>
            <th scope="col"></th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @foreach($places as $place)
            <tr>
                <td><b>{{ $place->name }}</b></td>
                <td><b>{{ $place->description }}</b></td>
                <td><b>{{ $place->type }}</b></td>
                <td><a class="Polaris-Button" href="{{ route('admin.places.edit', $place->id) }}"><i class="fa fa-pencil"></i> Edit</a></td>
                <td><a class="Polaris-Button" href="{{ route('admin.places.show', $place->id) }}"><i class="fa  fa-eye"></i> Show</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    


@endsection