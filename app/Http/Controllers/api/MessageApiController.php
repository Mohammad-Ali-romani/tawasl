<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageApiController extends Controller
{
    public function index()
    {
        $messages = Message::where(
            'cosigner_id', auth()->id()
        )->orWhere(
            'sender_id', auth()->id()
        )
            ->groupBy(['cosigner_id'])
            ->having('cosigner_id', '!=', auth()->id())
            ->orderBy('id', 'desc')
            ->get(['cosigner_id']);
        return $messages;
    }

    public function show($id)
    {
        $messages = auth()->user()->comsigners;
        foreach ($messages as $message) {
            $message->is_new = false;
            $message->save();
        }
        return Message::
            where('cosigner_id',auth()->user()->id)
            ->where('sender_id', $id)
            ->orWhere('sender_id',auth()->user()->id)
            ->where('cosigner_id' , $id)
            ->orderBy('id', 'desc')
            ->get();

    }

    public function store($id, Request $request)
    {
        //   $message = auth()->user()->senders()->create([
        //       'cosigner_id'=>$id,
        //       'text'=>$request->text
        //   ]);
        $send = new Message();
        $send->cosigner_id = $id;
        $send->text = $request->text;
        $message = auth()->user()->senders();
        $message->save($send);
        return Response([
            'status' => 'success',
            'message' => $request->text
        ]);
    }
}
