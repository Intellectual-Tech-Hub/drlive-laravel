<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\ChMessage;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    
    public function chat(Request $request)
    {
        $user = $request->user_id;

        if ($user == NULL) {
            return response()->json([
                'result' => false,
                'message' => 'please provide user id'
            ],404);
        }

        $messages = ChMessage::with(['from' => function($query){
            $query->select('id','first_name');
        }])->with(['to' => function($query){
            $query->select('id','first_name');
        }])->where('from_id',$user)->select('id','from_id','to_id','body','created_at')->get();

        if ($messages) {
            return response()->json([
                'result' => true,
                'chats' => $messages,
            ],200);
        }
        else {
            return response()->json([
                'result' => false,
                'message' => 'no chats found'
            ],404);
        }

    }

    public function specificchat(Request $request)
    {
        $from = $request->from_id;
        $to = $request->to_id;

        if ($from == NULL || $to == NULL) {
            return response()->json([
                'result' => false,
                'message' => 'please provide from and to user id'
            ],404);
        }

        $messages = ChMessage::with(['from' => function($query){
            $query->select('id','first_name');
        }])->with(['to' => function($query){
            $query->select('id','first_name');
        }])->where('from_id',$from)->where('to_id',$to)->select('id','from_id','to_id','body','created_at')->get();

        if ($messages) {
            return response()->json([
                'result' => true,
                'chats' => $messages,
            ],200);
        }
        else {
            return response()->json([
                'result' => false,
                'message' => 'no chats found'
            ],404);
        }
    }

    public function send(Request $request)
    {
        $from = $request->from_id;
        $to = $request->to_id;
        $message = $request->message;
        $type = 'user';

        if ($from == NULL || $to == NULL || $message == NULL) {
            return response()->json([
                'result' => false,
                'message' => 'insert all required fields'
            ]);
        }

        $chat = new ChMessage();
        $chat->id = mt_rand(9, 999999999) + time();
        $chat->type = $type;
        $chat->from_id = $from;
        $chat->to_id = $to;
        $chat->body = $message;
        $chat->save();

        return response()->json([
            'result' => true,
            'chat' => $chat,
        ]);

    }

}
