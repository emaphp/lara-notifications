@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top:45px;">
        <h1>Tag detail</h1>

        <form action="{{ route('admin.tags.destroy',  $tag->id) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <div class="form-group">
                <label for="name_tag">Name:</label>
                <input type="text" name="name_tag" id="name_tag" class="form-control" value="{{ $tag->name }}" readOnly>
            </div>
            <p><button type="submit" class="btn btn-primary" /><i class="fa fa-minus-circle"></i> Remove</button>
        </form>

        <a class="btn btn-link" href="{{ route('admin.tags.index') }}"><i class="fa fa-arrow-circle-left"></i> Back</a> 
    </div>

    </div>
@endsection