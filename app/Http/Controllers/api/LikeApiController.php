<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeApiController extends Controller
{
    public function index($id)
    {
        $post = Post::find($id);
        return $post->likes;
    }
    public function store($id)
    {
        $like = Like::where([
            'post_id' => $id,
            'user_id' => auth()->id()
        ]);
        if ($like->count() != 0)
            return Response([
                'status' => 'un success',
                'message' => 'You cannot put more than one like on the same post .',
            ],401);
        $like = Like::create([
            'post_id' => $id,
            'user_id' => auth()->id()
        ]);
        $name = auth()->user()->name;
        $post = Post::find($id);
        $post->num_likes= $post->num_likes+1;
        $post->save();
        $user = $post->user;
        $user->notifications()->create([
            'text'=> "أعجب $name بمنشور لك .",
            'link'=>route('posts.show',$id),
            'subject_id'=>auth()->id()
        ]);
        return Response([
                'status' => 'success',
                'like' => $like
            ],201);
    }
    public function destroy($id){
        $like = Like::where([
            'post_id' => $id,
            'user_id' => auth()->user()->id
        ]);
        if($like->count() == 0){
            return Response([
                'status'=>'un success',
                'message'=>'Like not found .'
            ],401);
        }
        $like->delete();
        $post = Post::find($id);
        $post->num_likes = $post->num_likes - 1;
        $post->save();
        return Response([
            'status'=>'success',
            'message'=>'Like deleted successfully .'
        ],201);
    }
}
