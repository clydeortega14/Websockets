<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class PostsController extends Controller
{
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'title' => 'required',
            'body' => 'required'
        ]);

        DB::beginTransaction();

        try {
            
            Post::create([
                'user_id' => auth()->user()->id,
                'title' => $request->input('title'),
                'body' => $request->input('body')
            ]);

        } catch (Exception $e) {
            
            DB::rollback();
            return back();
        }

        DB::commit();

        return redirect()->route('home')->with('success', 'new post has been created');
        


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
        $post = Post::findOrFail($id);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        DB::beginTransaction();

        try {

            Post::where('id', $id)->update([
                'title' => $request->input('title'),
                'body' => $request->input('body')
            ]);
            
        } catch (Exception $e) {
            
            DB::rollback();

            return back();
        }

        DB::commit();
        

        return redirect()->route('home')->with('success', 'Post has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
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
