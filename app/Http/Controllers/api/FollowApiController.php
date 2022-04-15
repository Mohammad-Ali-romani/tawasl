<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class FollowApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexFollowMe()
    {
        return auth()->user()->followeds()
            ->with('userFollower')
            ->get();
    }

    public function indexFollowTheir()
    {
        return auth()->user()->followers()
            ->with('userFollowed')
            ->get();
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($id)
    {
        $user = User::find($id);
        $followers = auth()->user()->followeds;
        foreach ($followers as $follower) {
            if ($follower->follower_id == $id)
                return Response([
                    'status' => 'un success',
                    'message' => "You are already following $user->name"
                ], 401);
        }
        auth()->user()->followeds()->create([
            'follower_id' => $id
        ]);
        auth()->user()->update([
            'num_followers' => auth()->user()->followers()->count(),
        ]);
        $user->update([
            'num_followers_me' => $user->followeds()->count()
        ]);
        $name = auth()->user()->name;
        $user->notifications()->create([
            'text' => "قام $name بمتابعتك .",
            'link' => route('api.users.show', auth()->id()),
            'subject_id' => auth()->id()
        ]);
        return Response([
            'status' => 'success',
            'message' => "you followed $user->name"
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        auth()->user()->followeds()->where(
            'follower_id', $id
        )->delete();
        $user->num_followers_me = $user->num_followers_me - 1;
        $user->save();
        return Response([
            'status' => 'success',
            'message' => "you unfollowed $user->name"
        ], 201);
    }
}
