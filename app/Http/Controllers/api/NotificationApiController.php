<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Notifaction;
use Illuminate\Http\Request;

class NotificationApiController extends Controller
{
    public function index()
    {
        return Notifaction::where('user_id',auth()->id())->with('userNotifa')->get();
    }
    public function click($id){
         $notification = Notifaction::find($id);
         if($notification->is_old)
             return Response([
                 'status'=>'un success',
                 'message'=>'It is really old .'
             ],401);
         return Response([
             'status'=>'success',
             'message'=>'operation accomplished successfully .'
         ],201);
    }
}
