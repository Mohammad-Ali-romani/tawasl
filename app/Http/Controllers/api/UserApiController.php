<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserApiController extends Controller
{
    public function showMe()
    {
        auth()->user()->update([
            'num_posts'=>auth()->user()->posts()->count(),
            'num_followers'=>auth()->user()->followers()->count(),
            'num_followers_me'=>auth()->user()->followeds()->count(),
        ]);
        return auth()->user();
    }
    public function show($id)
    {
        $user = User::where([
            'is_admin'=>false,
            'is_block'=>false
        ])->with('posts',function($q){
            return $q->where('is_block',false)->with('comments',function($q){
                return $q->where('is_block',false)->with('user');
            })->with('likes',function($q){
                return $q->with('user');
            })->with('shares')->with('files');
        })->with('followers',function($q){
            $q->with('userFollowed');
        })->with('followeds',function($q){
            $q->with('userFollower');
        })->find($id);
        if(!$user)
            return Response([
                'status'=>'Un success',
                'message'=>'user not found',
            ],404);
        return $user;
    }
    public function login(LoginRequest $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
//            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            return Response([
                'message'=> 'The information entered is wrong .'
            ],401);
        }

        return Response([
            'user'=>$user,
            'token'=>$user->createToken("app")->plainTextToken
        ],201);
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',//unique:App
            'password' => 'required|min:8|confirmed',
        ]);
        $user = User::create([
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        return Response([
            'user'=>$user,
            'token'=>$user->createToken("app")->plainTextToken
        ],201);
    }
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return [
            'message'=>'logout'
        ];
    }

    public function store(Request $request){
        $user = User::find(auth()->user()->id);
        $validatedData = $request->validate([
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $user->name = $request->name;
        $user->date_birth = $request->date_birth;
        $user->gender = $request->gender;
        if($request->avatar){
            $fileName = auth()->id() . '_' . time() . '.'. $request->avatar->extension();
            $type = $request->avatar->getClientMimeType();
            $size = $request->avatar->getSize();
            $request->avatar->move(public_path('users/avatars'), $fileName);
            $user->avatar = $fileName;
        }
        $user->save();
        return Response([
            'status'=>'success',
            'user'=>$user
        ]);
    }
    public function update(Request $request){
        $user = User::find(auth()->user()->id);
        $validatedData = $request->validate([
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->date_birth = $request->date_birth;
        $user->gender = $request->gender;
        $user->country = $request->country;
        if($request->avatar){
            $fileName = auth()->id() . '_' . time() . '.'. $request->avatar->extension();
            $type = $request->avatar->getClientMimeType();
            $size = $request->avatar->getSize();
            $file = $request->avatar->move(public_path('posts/medias'), $fileName);
            $user->avatar = $file;
        }
        $user->save();
        return Response([
            'status'=>'success',
            'user'=>$user
        ]);
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);
        $user = User::find(auth()->user()->id);
        if (!Hash::check($request->old_password, $user->password)) {
            return Response([
                'status' => 'unsuccess',
                'message' => 'Password error (incorrect password) !!!',
            ], 401);
        }
        $user->password = Hash::make($request->password);
        $user->save();
        return Response([
            'status' => 'success',
            'user' => $user,
        ], 201);
    }
    public function search($text)
    {
        return User::where('name','like',"%$text%")
            ->orWhere('email','like',"%$text%")->get();
    }
}
