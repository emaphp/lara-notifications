@extends('layouts.app')
    @section('content')
    <div class="container" style="margin-top:45px;">
    <h1>Tag detail</h1>
        <form action="{{ route('tags.destroy',  $tag->id) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <div class="form-group">
            <label for="name_tag">Name:</label>
            <input type="text" name="name_tag" id="name_tag" class="form-control" value="{{ $tag->name }}" readOnly>
            </div>
            <p><button type="submit" class="btn btn-primary" />Remove</button>
        </form>



        
        <div class="card bg-light mb-3" style="max-width: 18rem;">
                <div class="card-header">Tag detail</div>
                <div class="card-body">
                    <h5 class="card-title">Tag Name</h5>
                    <p class="card-text">{{ $tag->name }}</p>
                </div>
            </div>





        
        <div class="card">
        <div class="card-header">Tag Detail</div>
            <div class="card-body">
                Tag Name : {{ $tag->name }}
            </div>
        </div>
        <br>
        <form action="{{ route('tags.destroy',  $tag->id) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <button type="submit" class="btn btn-primary" />Remove</button>
        </form>
    </div>

    </div>


    

    @endsection