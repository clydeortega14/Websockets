@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h3>Edit Post</h3>

            <form action="{{ route('posts.update', $post->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="title"> Title </label>
                    
                    <input type="text" id="title" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}" value="{{ $post->title }}" placeholder="Enter Title">

                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="body">Description</label>

                    <textarea type="text" id="body" name="body" rows="10" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" placeholder="Enter Body">{{ $post->body }}</textarea>
                    @if ($errors->has('body'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('body') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success float-right">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection