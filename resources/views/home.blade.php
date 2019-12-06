@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between">
        <div class="col-md-4">
            <h1>Posts</h1>
        </div>
        <div class="col-md-4">
            <a href="{{ route('posts.create') }}" class="btn btn-primary float-right">Add Post</a>
        </div>

        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>
                                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-warning btn-sm">view</a> |
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-success btn-sm">edit</a> 
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="text-center">
                    {{ $posts->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
