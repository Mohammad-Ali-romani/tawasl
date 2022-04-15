<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Notifaction;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentApiController extends Controller
{
    public function index($id)
    {
//        $post = Post::find($id);
       return  Comment::where([
           'post_id'=>$id,
           'is_block'=>false
       ])->with('user')->get();
//        return $post->comments->where('is_block',false)->with('users')->get();
    }

    public function store($id,Request $request)
    {
        $comment = new Comment();
        $comment->text = $request->text;
        $comment->user_id = auth()->user()->id;
        $comment->post_id = $id;
        $comment->save();
        $name = auth()->user()->name;
        $post = Post::find($id);
        $post->num_comments = $post->num_comments +1;
        $post->save();
        $user = $post->user;

        $user->notifications()->create([
            'text'=>"فام $name بالتعليق على منشورك .",
            'link'=>route('posts.show',$id),
            'subject_id'=>auth()->id()
        ]);
        return Response([
            'statue'=>'success',
            'comment'=>$comment
        ],201);
    }
}
