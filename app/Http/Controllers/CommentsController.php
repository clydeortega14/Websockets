<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;
use App\Post;
use App\Events\NewComment;

class CommentsController extends Controller
{
    public function store(Request $request, Post $post)
    {
    	$comment = Comment::create([

    		'user_id' => auth()->user()->id,
    		'post_id' => $post->id,
    		'comment' => $request->json('body')
    	]);

        $comment = Comment::where('id', $comment->id)->with('user')->first();
        broadcast(new NewComment($comment))->toOthers();
    	return response()->json($comment);
    }
    public function index(Post $post)
    {
    	return response()->json($post->comments()
            ->with('user')
            ->get());
    }
}
