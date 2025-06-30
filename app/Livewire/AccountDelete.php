<?php

namespace App\Livewire;

use App\Mail\AccountDeleteMail;
use App\Models\Chatmessage;
use App\Models\Pet;
use App\Models\PetLike;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class AccountDelete extends Component
{

    public function accountDelete()
    {

        $userid = Auth::user()->id;
        $user = Auth::user();

        // chat history delete
        $chats = Chatmessage::where('sender_id', $userid)->orWhere('receiver_id', $userid)->get();

        foreach ($chats as $chat) {
            File::delete(public_path('images/' . $chat->media));
            $chat->delete();
        }

        // Pet listing delete
        $pets = Pet::where('owner_id', $userid)->get();

        foreach ($pets as $pet) {
            File::delete(public_path('images/' . $pet->image));
            $pet->delete();
        }

        //pet like delete
        PetLike::where('user_id', $userid)->delete();

        // user deltails delete

        UserDetail::where('user_id', $userid)->delete();

        // mail send
        Mail::to($user->email)->send(new AccountDeleteMail($user));


        $user = auth()->user();
        $user->delete();

        // Logout the user
        auth()->logout();

        // Redirect to the login page with a success message
        session()->flash('message', 'Your account has been successfully deleted.');
        return redirect()->route('f.login');
    }

    public function render()
    {
        return view('livewire.account-delete');
    }
}
