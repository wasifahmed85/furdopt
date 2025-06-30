<?php

namespace App\Http\Livewire;

use App\Models\Chatmessage;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use DB;
use Livewire\Attributes\Title;

class Message extends Component
{

    #[Title(' Message')]
    public $users;
    public $sender;
    public $message;
    public $user_id;
    public $receiver_id;
    public $allmessages;
    public $searchTerm;




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
        $data = new Chatmessage();
        $data->user_id = Auth::user()->id;
        $data->receiver_id = $this->sender->id;
        $data->message = $this->message;
        $data->save();
        $this->resetForm();
    }

    public function getUser($userId)
    {

        $user = User::findorfail($userId);

        $this->sender = $user;

        $this->allmessages = Chatmessage::where('user_id', Auth::user()->id)->where('receiver_id', $userId)->orWhere('user_id', $userId)->where('receiver_id', Auth::user()->id)->get();
    }



    public function render()
    {
        if ($this->searchTerm > 0) {
            $this->users = User::where('name', 'LIKE', '%' . $this->searchTerm . '%')
                ->where('role_id', 2)
                ->get()
                ->except(Auth::id());
        } else {
            //  $this->users = User::
            // ->get()
            // ->except(Auth::id());

            $authUser = Auth::user();


            $this->users = $authUser->sentChats->pluck('receiver')
                ->merge($authUser->receivedChats->pluck('sender'))
                ->unique();
        }



        $sender = $this->sender;

        $this->allmessages;

        return view('livewire.message');
    }
}
