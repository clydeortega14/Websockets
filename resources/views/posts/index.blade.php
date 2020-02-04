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
                <table class="table table-bordered" id="myTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Title</th>
                            <th>Created</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection


@section('custom_js')

<script>
    
   $(document).ready( function () {

        $('#myTable').DataTable({

            dom : 'ftp',
            pageLength : 10,
            processing : true,
            serverSide : true,
            ajax : 'post-data',
            columns : [

                {data : 'user', name : 'user.name'},
                {data : 'title'},
                {data : 'created_at'},
                {data : 'action'},
            ]

        });

    });
</script>

@endsection
