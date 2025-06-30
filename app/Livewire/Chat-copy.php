<?php

namespace App\Livewire;

use App\Models\BlockUser;
use App\Models\Chatmessage;
use App\Models\User;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Request;

class Chat extends Component
{
    use WithFileUploads;
    public $users;
    public $sender;
    public $message;
    public $user_id;
    public $receiver_id;
    public $allmessages;
    public $searchTerm;
    public $media;
    public $fileupload = false;
    #[Title(' chat')]



    public function activeStatusToggle()
    {
        $status = Auth::user();
        if ($status->active_status == 1) {
            $status->update(['active_status' => 0]);
        } else {
            $status->update(['active_status' => 1]);
        }
    }


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

        // if ($this->media) {

        //     $imageName = time() . '.' . $this->media->getClientOriginalExtension();

        //     $path = $this->media->store('images', name: $imageName);

        //     $data->media = $imageName;
        //     $this->reset('media');
        // }
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

        $this->allmessages = Chatmessage::where('user_id', Auth::user()->id)->where('receiver_id', $userId)->orWhere('user_id', $userId)->where('receiver_id', Auth::user()->id)->get();
    }

    public function fileUpload()
    {
        $this->fileupload = true;
    }



    public function conversationDelete($id)
    {

        $chatDelete = Chatmessage::where('user_id', Auth::user()->id)->where('receiver_id', $id)->orWhere('user_id', $id)->where('receiver_id', Auth::user()->id)->delete();
    }


    public function blockUser($id)
    {

        $block = BlockUser::create([
            'user_id' => Auth::user()->id,
            'blocked_user_id' => $id
        ]);
    }


    public function render()
    {
        // $blockUser = BlockUser::where('user_id', Auth::user()->id)->pluck('blocked_user_id')->toArray();

        // if ($this->searchTerm > 0) {
        //     $this->users = User::where('name', 'LIKE', '%' . $this->searchTerm . '%')
        //         ->whereNotIn('id', [Auth::user()->id, $blockUser])
        //         ->get();
        // } else {

        //     $this->users = User::where('name', 'LIKE', '%' . $this->searchTerm . '%')
        //         ->whereNotIn('id', [Auth::user()->id, $blockUser])
        //         ->get();
        // }

        $blockUser = BlockUser::where('user_id', Auth::id())->pluck('blocked_user_id')->toArray();


        $excludedUsers = array_merge([Auth::id()], $blockUser);

        $this->users = User::where('name', 'LIKE', '%' . $this->searchTerm . '%')
            ->whereNotIn('id', $excludedUsers)
            ->get();


        $sender = $this->sender;

        $this->allmessages;

        return view('livewire.chat');
    }
}
