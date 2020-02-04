@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-start">
        <div class="col-md-12">
            <h3>{{ $post->title}}</h3>
            <hr>
            <br>
            <p>{{ $post->body}}</p>
            <br>
            <small>Authored By : {{ $post->user->email }}</small>
            <hr>
        </div>

        <div class="col-md-12">

            <h3>Comments</h3>
            <div id="for-comments">
                <div v-if="user">

                    <input type="hidden" id="post-id" v-model="post">

                    <div class="form-group">
                        <textarea name="body" id="comment-body" v-model="commentBox" class="form-control" placeholder="Enter Your Comment"></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success float-right" @click.prevent="postComment">Submit</button>
                    </div>
                        
                </div>

                <div v-else>
                    <p>You must log in so that you create a comment <a href="{{ route('login') }}">Login Now</a></p>
                </div>

                <div class="media" style="margin-top:20px;" v-for="comment in comments">
                    <div class="media-left">
                        <a href="#">
                            <img class="mr-3" src="http://placeimg.com/80/80" alt="...">
                        </a>
                    </div>
                    <div class="media-body">
                        <h5 class="mt-0">@{{ comment.user.name}}</h5>
                        @{{comment.comment}}<br>
                        <small style="color: #aaa;">on @{{comment.created_at}}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 @endsection


@section('custom_js')
<script>

    const app = new Vue({

        el : '#for-comments',
        data : {

            comments : {},
            commentBox : '',
            post : {!! $post->toJson() !!},
            user : {!! auth()->check() ? auth()->user()->toJson() : 'null' !!}
        },
        mounted() {
            this.getComments()
            this.listen()
        },
        methods : {

            getComments(){

                axios.get(`/api/post/${this.post.id}/comments`).then(res => {
                    this.comments = res.data
                }).catch(error => {

                    console.log(error)
                })
            },
            postComment(){
                var postData = {
                    body : this.commentBox
                }

                axios.post(`/api/post/${this.post.id}/comment`, postData).then( res => {

                    this.comments.unshift(res.data)
                    this.commentBox = ''

                }).catch( error => {

                    console.log(error)
                })
            },
            listen(){
                Echo.private('home')
                    .listen('NewComment', (e) => {
                        this.comments.unshift(e.comment)
                    })

                Echo.private(`App.User.${this.post.user_id}`)
                    .notification((notification) => {
                        console.log(notification)
                    })
            },
        }
    })
</script>

@endsection