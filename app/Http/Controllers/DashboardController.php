<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\Share;
use App\Models\User;
use Illuminate\Http\Request;
use \Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $numberPosts = Post::count('id');
        $numberComments = Comment::count('id');
        $numberUsers = User::count('id');
        $numberShares = Share::count('id');
        $numberLikes = Like::count('id');
        $numberPostsToday = Post::groupBy('created_at')->having('created_at', '>=', date('Y-m-d'))->get('created_at')->count();
        $topUsers = User::where('is_admin',false)->withCount('posts')->orderBy('posts_count', 'desc')->take(5)->get();
//        return [
//            'number'=>$numberPosts,
//            'number comments'=>$numberComments,
//            'number users'=>$numUsers,
//            'number shares'=>$numShares,
//            'number Likes'=>$numLikes,
//            'number Posts ToDay'=>$numPostsToDay,
//            'top users'=>$topUser
//        ];
        return view('dashboard', compact('numberPosts', 'numberComments', 'numberUsers', 'numberShares', 'numberLikes', 'numberPostsToday', 'topUsers'));
    }
}
