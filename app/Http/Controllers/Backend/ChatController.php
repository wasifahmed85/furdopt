<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Chatmessage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ChatController extends Controller
{

    public function index()
    {
        Gate::authorize('chat_list_access');
        $conversations = ChatMessage::select('user_id', 'receiver_id')
            ->distinct()
            ->with(['sender', 'receiver'])
            ->latest()
            ->paginate(15);
        return view('backend.chat.index', compact('conversations'));
    }

    public function viewConversation($user1_id, $user2_id)
    {

        Gate::authorize('chat_conversation_view');
        $messages = ChatMessage::where(function ($query) use ($user1_id, $user2_id) {
            $query->where('user_id', $user1_id)
                ->where('receiver_id', $user2_id);
        })
            ->orWhere(function ($query) use ($user1_id, $user2_id) {
                $query->where('user_id', $user2_id)
                    ->where('receiver_id', $user1_id);
            })
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc')
            ->get();

        $user1 = User::find($user1_id);
        $user2 = User::find($user2_id);


        return view('backend.chat.conversation', compact('messages', 'user1', 'user2'));
    }
    public function chat()
    {


        Gate::authorize('chat_list_access');
        return view('backend.chat.chat');
    }
}
