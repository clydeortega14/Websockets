@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h3>Create New Post</h3>

            <form action="{{ route('posts.store') }}" method="POST">
                
                @csrf
                <div class="form-group">
                    <input type="text" name="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}" placeholder="Enter Title">

                    @if ($errors->has('title'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <textarea type="text" rows="10" name="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" placeholder="Enter Body"></textarea>
                    @if ($errors->has('body'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('body') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success float-right">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection