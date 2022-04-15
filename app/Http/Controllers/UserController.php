<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\SecondComment;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('is_admin',false)->orderBy('id','desc')->paginate(15);
        return view('users.index',compact('users'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
       //
    }
    //    block the post
    public function block(User $user)
    {
        $user->is_block = true;
        $user->save();
        return redirect()->back();
    }
    //    up block the post
    public function upBlock(User $user)
    {
        $user->is_block = false;
        $user->save();
        return redirect()->back();
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back();
    }
    public function search(Request $request)
    {
        $search = $request->search;
        $users = User::where([
            ['name','like','%'.$search.'%'],
            ['is_admin',false]
        ])->orderBy('id','desc')->paginate(15);
        return view('users.index',compact('users'));
    }
//    show posts to users
    public function showPosts($id)
    {
        $posts = Post::where('user_id',$id)->orderBy('id','desc')->paginate(15);
        return view('posts.index',compact('posts'));
    }
    public function showComments($id)
    {
        $comments = Comment::where('user_id',$id)->orderBy('id','desc')->paginate(15);
        foreach ($comments as $comment ) {
            $text = $comment->text;
            $comment->text = Str::excerpt($text);
        }
        return view('comments.index',compact('comments'));
    }
    public function showSecondComments($id)
    {
        $secondComments = SecondComment::where('user_id',$id)->orderBy('id','desc')->paginate(15);
        foreach ($secondComments as $secondComment ) {
            $text = $secondComment->text;
            $secondComment->text = Str::excerpt($text);
        }
        return view('comments.sec.index',compact('secondComments'));
    }

    public function showState($state)
    {
        $users = User::where([
            'is_admin'=>false,
            'is_block'=>$state
        ])->orderBy('id','desc')->paginate(15);
        return view('users.index',compact('users'));
    }
}
