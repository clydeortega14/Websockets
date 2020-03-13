<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Like;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Traits\FileTrait;
use Image;

class PostsController extends Controller
{
    use FileTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    public function all(Post $post)
    {
        $allPosts = $post->with(['user', 'comments.user', 'likes'])->orderBy('created_at', 'desc')->get();

        return response()->json($allPosts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        $data = $request->except('files');

        $image = $this->checkFile($request);

        $newPost = Post::create($data + ['file' => $image, 'user_id' => auth()->user()->id]);

        $post = Post::where('id', $newPost->id)->with(['user', 'comments', 'likes'])->first();

        return response()->json($post);
    }
    public function likePost(Request $request)
    {
        $dup_like = Like::where('user_id', auth()->user()->id)->where('post_id', $request->post_id)->first();

        if(!is_null($dup_like)){

           $dup_like->delete();

           return response()->json(['status' => false, 'post' => $this->postLikes($request)]);
           
        }else{

            $new_like = Like::create([
                'user_id' => auth()->user()->id,
                'post_id' => $request->post_id
            ]);

            $like = Like::where('id', $new_like->id)->with(['user'])->first();

            return response()->json(['status' => true, 'like' => $like]);
        }
    }
    public function postLikes(Request $request){

        return Post::where('id', $request->post_id)->with(['likes'])->first();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::where('id', $id)->with(['user', 'comments'])->first();

        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->except('files');

        $post = Post::findOrFail($post->id);

        if($request->hasFile('files')){

            $files = $request->file('files');

            $arrayImages = $this->loopFiles($files);

            $image = $this->manageArrayImages($arrayImages);

        }else{

            $image = $post->file;
        }

        $post->update($data + ['file' => $image]);
        
        return response()->json($post->with(['user', 'comments', 'likes'])->first());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            
            Post::where('id', $id)->delete();

        } catch (Exception $e) {
            
            DB::rollback();

            return response()->json($e->getMessage());
        }
        DB::commit();

        return response()->json('successfully Deleted');
    }

    public function postData()
    {
        $posts = Post::with(['user']);

        return datatables()
            ->eloquent($posts)
            ->addColumn('user', function(Post $post){

                return $post->user->name;

            })->addColumn('action', function(Post $post){

                $url = route('posts.show', $post->id);
                $editUrl = route('posts.edit', $post->id);

                return "<a href='{$url}' class='btn btn-warning btn-sm'><i class='fas fa-eye'></i></a> | <a href='{$editUrl}' class='btn btn-primary btn-sm'> <i class='fas fa-edit'></i></a>";

            })->addColumn('created_at', function(Post $post){

                return $post->created_at->diffForHumans();
            })
            ->rawColumns(['user', 'action'])->make();
    }
}
