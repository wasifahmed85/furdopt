<?php

namespace App\Livewire;

use App\Models\Chatmessage;
use App\Models\User;
use Illuminate\Console\View\Components\Alert;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class AdminChat extends Component
{
    use WithPagination;
    use WithFileUploads;
    public $users;
    public $sender;
    public $message;
    public $user_id;
    public $userId;
    public $receiver_id;
    public $allmessages;
    public $searchTerm;
    public $media;

    public function mountData()
    {
        if (isset($this->sender->id)) {
            $this->allmessages = Chatmessage::where('user_id', Auth::user()->id)->where('receiver_id', $this->sender->id)->orWhere('user_id', $this->sender->id)->where('receiver_id', Auth::user()->id)->get();
        }
    }
    public function resetForm()
    {
        $this->message = '';
    }
    public function sendMessage()
    {
        $validatedData = $this->validate([
            'message' => 'nullable|string|max:1000',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048', // Example: max 2MB
        ]);
        $data = new Chatmessage();
        $data->user_id = Auth::user()->id;
        $data->receiver_id = $this->sender->id;
        $data->message = $this->message;
        if ($this->media) {
            $imageName = time() . '.' . $this->media->getClientOriginalExtension();

            // Correct way to store with a specific name
            $path = $this->media->storeAs('images', $imageName, 'public'); // Saves in storage/app/public/images

            $data->media = $imageName;
            $this->reset('media');
        }
        $data->save();
        $this->resetForm();
    }
    public function getUser($userId)
    {


        $user = User::findorfail($userId);

        $this->sender = $user;

        $this->allmessages = Chatmessage::where('receiver_id', $userId)->orWhere('user_id', $userId)->get();
    }

    public function render()
    {
        $this->users = User::where('name', 'LIKE', '%' . $this->searchTerm . '%')

            ->paginate(10)
            ->except(Auth::id());
        $sender = $this->sender;

        $this->allmessages;

        $userId = $this->userId;
        return view('livewire.admin-chat');
    }
}
