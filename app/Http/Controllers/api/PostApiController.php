<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Follower;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PostApiController extends Controller
{
    public function index()
    {
        $followers = Follower::where('follower_id', auth()->id())->get('followed_id');
        global $id_followers;
        $id_followers = [];
        foreach ($followers as $follower) {
            array_push($id_followers, $follower->followed_id);
        }
        $posts = Post::where('is_block', false)->whereHas('user', function (Builder $query) {
            global $id_followers;
            $query->whereIn('id', $id_followers);
            $query->orWhere('id', auth()->id());
        })->with('files')->with('user')->with('comments', function ($query) {
            $query->orderBy('id', 'desc')->with('user');
        })->with('likes', function ($q) {
            $q->where('user_id', auth()->id())->with('user');
        })->orderBy('id', 'desc')->get();
        return $posts;
    }

    public function show($id)
    {
        return Post::with('user')
            ->with('comments', function ($q) {
                $q->with('user');
            })->with('likes',function ($q){
                $q->with('user');
            })
            ->with('shares')
            ->with('files')
            ->find($id);
    }

    public function showMe()
    {
        return Post::where([
            'is_block' => false,
            'user_id' => auth()->id()
        ])->with('comments', function ($q) {
            $q->with('user');
        })->with('files')->with('likes',function ($q){
            $q->with('user');
        })->with('shares')->get();
    }

    public function store(Request $request)
    {
        $post = new Post();
        $post->text = $request->text;
        $post->user_id = auth()->id();
        $post->save();
        auth()->user()->update([
            'num_posts' => auth()->user()->posts()->count()
        ]);
        if ($request->medias) {
            $index = 0;
            foreach ($request->medias as $media) {
                $fileName = auth()->id() . '_' . time(). rand(0,100) . $index . '.' . $media->extension();
                $media->move(public_path('posts/medias'), $fileName);
                $file = new File();
                $file->url = $fileName;
                $file->post_id = $post->id;
                $file->save();
                $index++;
            }
        }

        return Response([
            'status' => 'success',
            'post' => Post::with('files')->find($post->id)
        ], 201);
    }


    public function search($text)
    {
        return Post::where('text', 'like', "%$text%")->with('user')->get();
    }
}
