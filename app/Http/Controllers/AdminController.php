<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where([
            'is_admin'=>true,
            ['id','!=','1']
        ])->orderBy('id','desc')->get();
        return view('admins.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admins.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|string|max:255",
            'email' => "required|string|email|max:255|unique:users",
            'password' => ["required",Rules\Password::defaults()],
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender'=>$request->gender,
            'is_admin'=>true
        ]);
        return redirect()->route('admins.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admins.edit',compact('user'));
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
        $request->validate([
            'name' => "required|string|max:255",
            'email' => "required|string|email|max:255",
            'password' => ["required",Rules\Password::defaults()],
        ]);
        $user = User::find($id);
        if($request->password != null){
            $user->password = Hash::make($request->password);
        }

        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'gender'=>$request->gender,
        ]);
        return redirect()->route('admins.index');
    }
//    profile
    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => "required|string|max:255",
            'email' => "required|string|email|max:255",
            'password' => ['confirmed'],
            'date_birth'=>'date',
            'avatar'=>'image'
        ]);
        $user = User::find($id);
        if($request->password != null){
            $user->password = Hash::make($request->password);
            $user->save();
            auth()->logout();
        }
        else{

            if(isset($request->avatar)){
                $file = $request->avatar->move('avatars');
                if(auth()->user()->avatar != "images/avatar-default.jpg"){

                    try {
                        unlink(auth()->user()->avatar);
                    } catch (\Exception $e) {

                    }
                }
                $user->avatar = $file;
            }

            $user->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'gender'=>$request->gender,
            ]);
        }
        return redirect()->back()->with('success','تم تغيير البيانات بنجاح');

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
        return redirect()->route('admins.index');
    }
    public function search(Request $request)
    {
        $search = $request->search;
        $users = User::where([
            ['name','like','%'.$search.'%'],
            ['is_admin',true]
        ])->orderBy('id','desc')->paginate(15);
        return view('admins.index',compact('users'));
    }
//    edit profile
    public function editProfile()
    {
        return view('settings.profile');
    }
}
