@extends('layouts.app')

@section('content')

    <div class="container" style="margin-top:45px;">
        <h1>TAGS</h1>
        <a class="Polaris-Button" href="{{ route('admin.tags.create')}}"><i class="fa fa-plus"></i> Create new tag</a>
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
                <th scope="col">Actions</th>
                <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tags as $tag)
                <tr>
                    <td>{{ $tag->name }}</td>
                    <td><a class="Polaris-Button" href="{{ route('admin.tags.edit', $tag->id) }}"><i class="fa fa-pencil"></i> Edit</a></td>
                    <td><a class="Polaris-Button" href="{{ route('admin.tags.show', $tag->id) }}"><i class="fa  fa-eye"></i> Show</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection