<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;
use App\Models\ChatRoom;
use App\Events\NewChatMessage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;

class ChatController extends Controller
{
    //
    public function rooms(Request $request) {
        return ChatRoom::all();
    }
    // fetch messages
    public function messages( Request $request, $roomId) {
        $messages = ChatMessage::where('chat_room_id', $roomId)->with('user')->orderBy('created_at', 'DESC')->get();

        return $messages;
    }
    // create message
    public function newMessage (Request $request, $roomId) {
        $newMessage = new ChatMessage;
        $newMessage->user_id = $request->user()->id;
        $newMessage->chat_room_id = $roomId;
        // $newMessage->sender = 1;
        $newMessage->message = $request->message;
        $newMessage->save();

        broadcast(new NewChatMessage($newMessage))->toOthers();

        return $newMessage;
    }
}
