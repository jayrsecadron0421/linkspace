<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessengerController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $conversations = Conversation::where('user_one',$user->id)
            ->orWhere('user_two',$user->id)
            ->get();

        return view('messages', compact('conversations'));
    }

    public function open(User $user)
    {
        $auth = auth()->user();

        if ($auth->id == $user->id) abort(403);

        $conversation = Conversation::where(function($q) use ($auth,$user) {
            $q->where('user_one',$auth->id)->where('user_two',$user->id);
        })->orWhere(function($q) use ($auth,$user) {
            $q->where('user_one',$user->id)->where('user_two',$auth->id);
        })->first();

        if (!$conversation) {
            $conversation = Conversation::create([
                'user_one'=>$auth->id,
                'user_two'=>$user->id
            ]);
        }

        $messages = $conversation->messages()->with('sender')->get();

        return view('chat', compact('conversation','user','messages'));
    }

    public function send(Request $request, Conversation $conversation)
    {
        Message::create([
            'conversation_id'=>$conversation->id,
            'sender_id'=>auth()->id(),
            'body'=>$request->body
        ]);

        return back();
    }
}

