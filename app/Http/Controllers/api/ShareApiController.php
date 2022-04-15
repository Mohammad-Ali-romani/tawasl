<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Share;
use Illuminate\Http\Request;

class ShareApiController extends Controller
{
    public function store($id,Request $request){

        $share = Share::where([
            'user_id'=>auth()->user()->id,
            'post_id'=>$id,
        ]);
        if ($share->count() != 0)
            return Response([
                'status' => 'un success',
                'message' => 'You cannot put more than one share on the same post .',
            ],401);
        $share = Share::create([
            'user_id'=>auth()->user()->id,
            'post_id'=>$id,
            'text'=>$request->text??''
        ]);
        $post = Post::find($id);
        $post->num_shares = $post->num_shares +1 ;
        $post->save();
        return Response([
            'status'=>'success',
            'share'=>$share
        ],201);
    }

    public function destroy($id)
    {
        $share = Share::where([
            'user_id'=>auth()->id(),
            'post_id'=>$id,
        ]);
        if($share->count() == 0 )
            return Response([
                'status'=>'un success',
                'message'=>'share not found'
            ],401);
//        return $share;
        $share->delete();
        $post = Post::find($id);
        $post->num_shares = $post->num_shares -1 ;
        $post->save();
        return Response([
            'status'=>'success',
            'message'=>'Like deleted successfully .'
        ]);
    }
}
