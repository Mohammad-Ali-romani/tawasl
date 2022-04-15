<?php

namespace routes\web;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SecondCommentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
})->name('home');

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'dashboard'], function () {
    Route::get('/',function(){
        return redirect()->route('dashboard');
    });
    Route::get('/home', [DashboardController::class,'index'])->name('dashboard');
    //    this is the routes posts

    Route::get('posts/search',[PostController::class,'search'])->name('posts.search');
    Route::resource('posts', PostController::class);
    Route::get('posts/state/{state}', [PostController::class, 'showState'])->name('posts.state');
    Route::get('post/up-block/{post}',[PostController::class,'block'])->name('post.block');
    Route::get('post/block/{post}',[PostController::class,'upBlock'])->name('post.upBlock');
    Route::get('post/{post}/user',[PostController::class,'showUser'])->name('post.user');
    Route::get('post/{post}/comments',[PostController::class,'showComments'])->name('post.comments');

    //    this is the routes users
    Route::get('users/search',[UserController::class,'search'])->name('users.search');
    Route::resource('users', UserController::class);
    Route::get('user/{id}/posts', [UserController::class, 'showPosts'])->name('users.posts');
    Route::get('user/{id}/comments', [UserController::class, 'showComments'])->name('users.comments');
    Route::get('user/{id}/second-comments', [UserController::class, 'showSecondComments'])->name('users.secondComments');
    Route::get('users/state/{state}', [UserController::class, 'showState'])->name('users.state');
    Route::get('user/up-block/{user}',[UserController::class,'block'])->name('user.block');
    Route::get('user/block/{user}',[UserController::class,'upBlock'])->name('user.upBlock');
    Route::get('admins/search',[AdminController::class,'search'])->name('admins.search');
    Route::resource('admins', AdminController::class);
    //    this is the routes commments
    Route::get('comments/search',[CommentController::class,'search'])->name('comments.search');
    Route::resource('comments', CommentController::class);
    Route::get('comment/{comment}/user',[CommentController::class,'showUser'])->name('comment.user');
     Route::get('comment/up-block/{comment}',[CommentController::class,'upBlock'])->name('comment.upBlock');
     Route::get('comment/block/{comment}',[CommentController::class,'block'])->name('comment.block');
     Route::get('comment/{comment}/sec-comments/search',[secondCommentController::class,'search'])->name('secondComments.search');
     Route::get('comment/{comment}/sec-comments',[SecondCommentController::class,'index'])->name('seccomments.index');
    //     profile
    Route::get('profile',[AdminController::class,'editProfile'])->name('profile');
    Route::put('profile/{user}',[AdminController::class,'updateProfile'])->name('users.updateProfile');
});
require __DIR__ . '/auth.php';
