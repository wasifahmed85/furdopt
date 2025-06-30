<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Support\Facades\Gate;

class MessageController extends Controller
{
    public function index()
    {



        $messages = Message::latest()->get();
        return view('backend.messages.index', compact('messages'));
    }

    public function destroy()
    {
        // todo deleted lksdfjkasdjk
    }
}
