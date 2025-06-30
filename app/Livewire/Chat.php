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
use Illuminate\Support\Facades\DB;

class Chat extends Component
{
    use WithFileUploads;

    public $selectedUser;
    public $users;
    public $sender;
    public $message = '';
    public $user_id;
    public $receiver_id;
    public $allmessages = [];
    public $searchTerm;

    #[Validate('image|mimes:jpg,jpeg,png,gif,svg|max:2048')]
    public $media;

    public $fileupload = false;

    #[Title('Chat')]
    #[Validate('required|email')]
    public $subscriptNewsletter;

    public $success;

    /**
     * Toggle User Active Status
     */
    public function activeStatusToggle()
    {
        $user = Auth::user();
        $user->update(['active_status' => !$user->active_status]);
    }

    /**
     * Fetch messages between logged-in user and selected sender
     */
    public function mountData()
    {
        if ($this->sender) {
            $this->allmessages = Chatmessage::where(function ($query) {
                $query->where('user_id', Auth::id())
                    ->where('receiver_id', $this->sender->id);
            })->orWhere(function ($query) {
                $query->where('user_id', $this->sender->id)
                    ->where('receiver_id', Auth::id());
            })->get();
        }
    }

    /**
     * Reset input fields
     */
    public function resetForm()
    {
        $this->message = '';
        $this->media = null;
        $this->fileupload = false;
    }

    /**
     * Send a chat message
     */
    // public function sendMessage()
    // {
    //     $validatedData = $this->validate([
    //         'message' => 'nullable|string|max:1000',
    //         'media' => 'nullable|file|mimes:jpg,jpeg,png,gif,svg,doc,docx,pdf,txt|max:5120',
    //     ]);

    //     if (!$this->message && !$this->media) {
    //         session()->flash('error', 'Message or file is required.');
    //         return;
    //     }

    //     if ($this->message || $this->media) {
    //         $data = new Chatmessage();
    //         $data->user_id = Auth::id();
    //         $data->receiver_id = $this->sender->id;
    //         $data->message = $this->message ?? null;

    //         // if ($this->media) {
    //         //     $manager = new ImageManager(new Driver());
    //         //     $mediaName = uniqid() . '.webp';

    //         //     $image = $manager->read($this->media->getRealPath())
    //         //         ->cover(200, 200)
    //         //         ->toWebp(90);

    //         //     $imagePath = public_path('images/' . $mediaName);
    //         //     if (!File::exists(public_path('images'))) {
    //         //         File::makeDirectory(public_path('images'), 0777, true, true);
    //         //     }
    //         //     file_put_contents($imagePath, (string) $image);
    //         //     $data->media = $mediaName;
    //         // }

    //         if ($this->media) {
    //             $extension = $this->media->getClientOriginalExtension();
    //             $mediaName = uniqid() . '.' . $extension;

    //             // Define the storage path
    //             if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'svg'])) {
    //                 // Process image using Intervention Image
    //                 $manager = new ImageManager(new Driver());
    //                 $mediaName = uniqid() . '.webp'; // Convert all images to WebP

    //                 $image = $manager->read($this->media->getRealPath())
    //                     ->cover(200, 200) // Resize to 200x200
    //                     ->toWebp(90); // Convert to WebP

    //                 // Ensure directory exists
    //                 $imagePath = storage_path('app/public/images/' . $mediaName);
    //                 if (!File::exists(storage_path('app/public/images'))) {
    //                     File::makeDirectory(storage_path('app/public/images'), 0777, true, true);
    //                 }

    //                 // Save the processed image
    //                 file_put_contents($imagePath, (string) $image);
    //                 $data->media = $mediaName; // Save the relative path
    //             } else {
    //                 // Store non-image files in storage
    //                 $imagePath = storage_path('app/public/images/' . $mediaName);
    //                 if (!File::exists(storage_path('app/public/images'))) {
    //                     File::makeDirectory(storage_path('app/public/images'), 0777, true, true);
    //                 }
    //                 file_put_contents($imagePath, (string) $mediaName);
    //                 $data->media = $mediaName;
    //             }
    //         }

    //         $data->save();
    //     }
    //     $this->message = '';
    //     $this->media = null;
    //     $this->loadMessages();
    //     $this->resetForm();
    //     // $this->dispatch('messageSent');
    // }




    /**
     * Fetch a user's chat messages
     */
    public function getUser($userId)
    {


        $this->sender = User::findOrFail($userId);

        $this->allmessages = Chatmessage::where(function ($query) use ($userId) {
            $query->where('user_id', Auth::id())
                ->where('receiver_id', $userId);
        })->orWhere(function ($query) use ($userId) {
            $query->where('user_id', $userId)
                ->where('receiver_id', Auth::id());
        })->get();

        Chatmessage::where('user_id', $userId)
            ->where('receiver_id', Auth::id())
            ->update(['is_seen' => 1]);
    }

    /**
     * Enable file upload mode
     */
    public function fileUpload()
    {
        $this->fileupload = true;
    }

    /**
     * Delete conversation
     */
    public function conversationDelete($id)
    {
        Chatmessage::where(function ($query) use ($id) {
            $query->where('user_id', Auth::id())
                ->where('receiver_id', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('user_id', $id)
                ->where('receiver_id', Auth::id());
        })->delete();
    }

    /**
     * Block a user
     */
    public function blockUser($id)
    {
        if (!BlockUser::where('user_id', Auth::id())->where('blocked_user_id', $id)->exists()) {
            BlockUser::create([
                'user_id' => Auth::id(),
                'blocked_user_id' => $id
            ]);
        }

        $this->reset(['sender', 'allmessages']);
    }





    /**
     * Render the Livewire component
     */
    public function render()
    {
        $authUser = Auth::user();
            $include = $authUser->sentChats->pluck('receiver.id')
        ->merge($authUser->receivedChats->pluck('sender.id'))
        ->unique()
        ->values();

    $blockedUsers = BlockUser::where('user_id', $authUser->id)->pluck('blocked_user_id')->toArray();
    $excludedUsers = array_merge([$authUser->id], $blockedUsers);
                        
        $blockedUsers = BlockUser::where('user_id', Auth::id())->pluck('blocked_user_id')->toArray();
        $excludedUsers = array_merge([Auth::id()], $blockedUsers);
        
    

 
        $this->users = User::withCount(['receivedChats as unread_count' => function ($query) {
                        $query->where('is_seen', 0);
                    }])->with(['lastMessage' => function ($query) {
                        $query->where('user_id', auth()->id())
                              ->orWhere('receiver_id', auth()->id())
                              ->latest();
                    }])->where('name', 'LIKE', '%' . $this->searchTerm . '%')
                     ->whereIn('id', $include)
                        -> whereNotIn('id', $excludedUsers)
                        ->orderByDesc('unread_count') 
                            ->get();
    
//  $authUser = Auth::user();

//     $include = $authUser->sentChats->pluck('receiver.id')
//         ->merge($authUser->receivedChats->pluck('sender.id'))
//         ->unique()
//         ->values();

//     $blockedUsers = BlockUser::where('user_id', $authUser->id)->pluck('blocked_user_id')->toArray();
//     $excludedUsers = array_merge([$authUser->id], $blockedUsers);

//     $this->users = User::withCount(['receivedChats as unread_count' => function ($query) {
//         $query->where('is_seen', 0);
//     }])
//     ->with(['lastMessage' => function ($query) {
//         $query->where(function($q) {
//             $q->where('user_id', auth()->id())
//               ->orWhere('receiver_id', auth()->id());
//         })->latest();
//     }])
//     ->where('name', 'LIKE', '%' . $this->searchTerm . '%')
//     ->whereIn('id', $include)
//     ->whereNotIn('id', $excludedUsers)
//     ->orderByDesc('unread_count')
//     ->get();
        return view('livewire.chat');
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
}
