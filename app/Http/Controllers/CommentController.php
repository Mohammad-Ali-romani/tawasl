<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return view('comments.show',compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }
//    block the post
    public function block(Comment $comment)
    {
        $comment->is_block = true;
        $comment->save();
        return back();
    }
//    up block the post
    public function upBlock(Comment $comment)
    {
        $comment->is_block = false;
        $comment->save();
        return back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
    public function search(Request $request)
    {
        $search = $request->search;
        $comments = Comment::where(
            'text','like','%'.$search.'%'
        )->orderBy('id','desc')->paginate(15);
        return view('comments.index',compact('comments'));
    }
    public function showUser(Comment $comment)
    {
        $users = [];
        array_push($users,$comment->user);
        // return $users;
        return view('users.index',compact('users'));
    }
    // public function upBlock(Comment $comment)
    // {
    //     $comment->is_block = false;
    //     return
    // }
}
