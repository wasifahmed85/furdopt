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
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class SingleChat extends Component
{

    use WithFileUploads;
    public $users;
    public $user;
    public $sender;
    public $message;
    public $user_id;
    public $receiver_id;
    public $allmessages;
    public $searchTerm;
    public $media;
    public $fileupload = false;
    #[Title(' chat')]


    public function fileUpload()
    {
        $this->fileupload = true;
    }
    public function mount($userId)
    {

        $user = User::findorfail($userId);
        $this->user = $user;
        $this->sender = $user;

        $this->allmessages = Chatmessage::where('user_id', Auth::user()->id)->where('receiver_id', $userId)->orWhere('user_id', $userId)->where('receiver_id', Auth::user()->id)->get();
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
        $this->media = null;
        $this->fileupload = false;
    }

    public function sendMessage()
    {
        $validatedData = $this->validate([
            'message' => 'nullable|string|max:1000',
            'media' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg|max:5120',
        ]);

        if (!$this->message && !$this->media) {
            session()->flash('error', 'Message or file is required.');
            return;
        }

        if ($this->message || $this->media) {
            $data = new Chatmessage();
            $data->user_id = Auth::id();
            $data->receiver_id = $this->sender->id;
            $data->message = $this->message ?? null;


            $storagePath = public_path('images/');


            if (!File::exists($storagePath)) {
                File::makeDirectory($storagePath, 0777, true, true);
            }


            if ($this->media) {
                $extension = $this->media->getClientOriginalExtension();
                $mediaName = uniqid() . '.' . $extension;
                $filePath = $storagePath . $mediaName;


                if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'svg'])) {

                    $manager = new ImageManager(new Driver());
                    $mediaName = uniqid() . '.webp';
                    $filePath = $storagePath . $mediaName;

                    $image = $manager->read($this->media->getRealPath())
                        ->cover(200, 200)
                        ->toWebp(90);


                    file_put_contents($filePath, (string) $image);
                } else {

                    $this->media->move($storagePath, $mediaName);
                }


                $data->media = $mediaName;
            }

            $data->save();
        }

        $this->message = '';
        $this->media = null;

        $this->resetForm();
    }


    public function conversationDelete($id)
    {

        $chatDelete = Chatmessage::where('user_id', Auth::user()->id)->where('receiver_id', $id)->orWhere('user_id', $id)->where('receiver_id', Auth::user()->id)->delete();
    }


    public function blockUser($id)
    {

        // $block = BlockUser::create([
        //     'user_id' => Auth::user()->id,
        //     'blocked_user_id' => $id
        // ]);

        if (!BlockUser::where('user_id', Auth::id())->where('blocked_user_id', $id)->exists()) {
            BlockUser::create([
                'user_id' => Auth::id(),
                'blocked_user_id' => $id
            ]);
        }

        $this->reset();
    }

    public function getUser($userId)
    {

        $user = User::findorfail($userId);

        $this->sender = $user;

        $this->allmessages = Chatmessage::where('user_id', Auth::user()->id)->where('receiver_id', $userId)->orWhere('user_id', $userId)->where('receiver_id', Auth::user()->id)->get();
    }

    public function render()
    {
        return view('livewire.single-chat');
    }
}
