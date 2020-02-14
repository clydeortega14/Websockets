<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;
use App\Post;
use App\Events\NewComment;
use App\Notifications\CommentPost;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    public function store(Request $request, Post $post)
    {

        DB::beginTransaction();

        try {
            
            $comment = Comment::create([

                'user_id' => auth()->user()->id,
                'post_id' => $post->id,
                'comment' => $request->input('comment')
            ]);

            $comment = Comment::where('id', $comment->id)->with('user')->first();
            
            broadcast(new NewComment($comment))->toOthers();
            
            $comment->post->user->notify(new CommentPost($comment));

        } catch (Exception $e) {

            DB::rollback();

            return response()->json($e->getMessage());
            
        }

        DB::commit();
    	
    	return response()->json($comment);
    }
    public function index(Post $post)
    {
    	return response()->json($post->comments()
            ->with('user')
            ->get());
    }
}
