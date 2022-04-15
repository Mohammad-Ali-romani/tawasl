<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('id','desc')->paginate(15);
        foreach ($posts as $post ) {
            $text = $post->text;
            $post->text = Str::excerpt($text);
        }
        return view('posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show',compact('post'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }
//    block the post
    public function block(Post $post)
    {
        $post->is_block = true;
        $post->save();
        return back();
    }
//    up block the post
    public function upBlock(Post $post)
    {
        $post->is_block = false;
        $post->save();
        return back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
    public function search(Request $request)
    {
        $search = $request->search;
        $posts = Post::where('text','like','%'.$search.'%')->orderBy('id','desc')->paginate(15);
        return view('posts.index',compact('posts'));
    }
    public function showState($state)
    {
        $posts = Post::where([
            'is_block'=>$state
        ])->orderBy('id','desc')->paginate(15);
        return view('posts.index',compact('posts'));
    }
    public function showUser(Post $post)
    {
        $users = [];
        array_push($users,$post->user);
        return view('users.index',compact('users'));
    }
    public function showComments(Post $post)
    {

        $comments = Comment::where('post_id',$post->id)->orderBy('id','desc')->paginate(15);
        return view('comments.index',compact('comments'));
    }


}
