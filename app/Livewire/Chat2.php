<?php

namespace App\Livewire;

use App\Models\BlockUser;
use App\Models\Chatmessage;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;

class Chat2 extends Component
{
    use WithFileUploads;
    #[Title('Chat')]
    public $search = '';
    public $selectedUser;
    public $message;
    public $file;
    public $messages = [];



    public function render()
    {

        $users = User::where('id', '!=', Auth::id())
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->get();

        return view('livewire.chat-2', ['users' => $users]);
    }

    public function selectUser($userId)
    {
        $this->selectedUser = User::find($userId);
        $this->loadMessages();
    }

    public function loadMessages()
    {
        if (!$this->selectedUser) return;

        $this->messages = Chatmessage::where(function ($query) {
            $query->where('user_id', Auth::id())->where('receiver_id', $this->selectedUser->id);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->selectedUser->id)->where('user_id', Auth::id());
        })->orderBy('created_at')->get();
    }

    public function sendMessage()
    {
        if (!$this->selectedUser) return;

        // Ensure at least a message or a file is provided
        if (!$this->message && !$this->file) {
            session()->flash('error', 'Message or file is required.');
            return;
        }

        $chat = new Chatmessage();
        $chat->user_id = Auth::id();
        $chat->receiver_id = $this->sender->id;
        $chat->message = $this->message;

        if ($this->file) {
            $chat->file = $this->file->store('chat_files', 'public');
        }

        $chat->save();

        $this->message = '';
        $this->file = null;
        $this->loadMessages();
    }
}
