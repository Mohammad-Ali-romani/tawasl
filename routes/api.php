<?php

namespace routes;

use App\Http\Controllers\api\CommentApiController;
use App\Http\Controllers\api\FollowApiController;
use App\Http\Controllers\api\LikeApiController;
use App\Http\Controllers\api\MessageApiController;
use App\Http\Controllers\api\NotificationApiController;
use App\Http\Controllers\api\PostApiController;
use App\Http\Controllers\api\ShareApiController;
use App\Http\Controllers\api\UserApiController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('cors')->group(function () {

// authentcation
    Route::post('login', [UserApiController::class, 'login']);
    Route::post('register', [UserApiController::class, 'register']);
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');
    Route::group(['middleware' => 'auth:sanctum'], function () {
//    auth
        Route::post('logout', [UserApiController::class, 'logout']);
//    all
//    api users
        Route::group(['prefix' => 'user/'], function () {
            Route::get('/',[UserApiController::class,'showMe']);
            Route::post('store', [UserApiController::class, 'store']);
            Route::post('update', [UserApiController::class, 'update']);
            Route::post('update-password', [UserApiController::class, 'updatePassword']);
//            Route::post('reset-password', [UserApiController::class, 'resetPassword']);

//        follows
            Route::get('follow-me', [FollowApiController::class, 'indexFollowMe']);
            Route::get('follow-their', [FollowApiController::class, 'indexFollowTheir']);
            Route::post('follow/{id}', [FollowApiController::class, 'store']);
            Route::delete('follow/{id}', [FollowApiController::class, 'destroy']);
            Route::get('/{id}',[UserApiController::class,'show'])->name('api.users.show');
        });
        Route::get('users/search/{text}',[UserApiController::class,'search']);

        Route::prefix('posts')->group(function(){
            //    api posts
            Route::get('/', [PostApiController::class, 'index']);
            Route::post('/', [PostApiController::class, 'store']);
            Route::get('/me', [PostApiController::class, 'showMe']);
            Route::get('/{id}', [PostApiController::class, 'show'])->name('posts.show');
            Route::get('/search/{text}',[PostApiController::class,'search']);
        });

        Route::prefix('post')->group(function(){
            //    api likes

            Route::get('/{id}/likes', [LikeApiController::class, 'index']);
            Route::post('/{id}/like', [LikeApiController::class, 'store']);
            Route::delete('/{id}/like', [LikeApiController::class, 'destroy']);
            //    api shares
            Route::post('/{id}/share', [ShareApiController::class, 'store']);
            Route::delete('/{id}/share', [ShareApiController::class, 'destroy']);
            //    api comments
            Route::get('/{id}/comments', [CommentApiController::class, 'index']);
            Route::post('/{id}/comment', [CommentApiController::class, 'store']);
        });
        Route::prefix('messages')->group(function(){
            //    api messages
            Route::get('/', [MessageApiController::class, 'index']);
            Route::get('/{id}', [MessageApiController::class, 'show']);
            Route::post('/{id}', [MessageApiController::class, 'store']);
        });
        //        api notifications
        Route::get('notifications',[NotificationApiController::class,'index']);
        Route::post('notifications',[NotificationApiController::class,'store']);
        Route::get('notification/click/{id}',[NotificationApiController::class,'click']);

    });

});
