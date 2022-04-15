<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\SecondComment;
use Illuminate\Http\Request;

class SecondCommentController extends Controller
{

    public function index(Comment $comment)
    {
        $secondComments = $comment->secondComments()->paginate(15);
        return view('comments.sec.index',compact('secondComments','comment'));
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
     * @param  \App\Models\SecondComment  $secondComment
     * @return \Illuminate\Http\Response
     */
    public function show(SecondComment $secondComment)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SecondComment  $secondComment
     * @return \Illuminate\Http\Response
     */
    public function edit(SecondComment $secondComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SecondComment  $secondComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SecondComment $secondComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SecondComment  $secondComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(SecondComment $secondComment)
    {
        //
    }

    public function search(Request $request, Comment $comment)
    {
        $search = $request->search;
        $secondComments = $comment->secondComments()->where('text','like','%'.$search.'%')->paginate(15);

        return view('comments.sec.index',compact('secondComments','comment'));
    }
}
