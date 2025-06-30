<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;

class EditProfile extends Component
{
    use WithFileUploads;

    public $avatar;
    public $showModal = false;
    public $currentImage;
    #[Title(' Edit Profile')]
    public function mount()
    {
        $this->currentImage = auth()->user()->avatar ?? 'default.jpg';
    }

    public function updatedImage()
    {
        $this->validate([
            'avatar' => 'image|max:1024',
        ]);
    }

    public function saveAvatar()
    {


        $this->validate([
            'avatar' => 'image|max:1024',
        ]);

        $imageName = time() . '.' . $this->media->getClientOriginalExtension();

        // Correct way to store with a specific name
        $path = $this->avatar->storeAs('images', $imageName, 'public');

        auth()->user()->update([
            'avatar' => $imageName
        ]);


        $this->showModal = false;
        $this->avatar = null;

        session()->flash('message', 'Profile photo updated successfully!');
    }

    // public function imageUpload()
    // {

    //     $status = Auth::user();
    //     $validatedData = $this->validate([

    //         'media' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048', // Example: max 2MB
    //     ]);

    //     if ($this->media) {
    //         $imageName = time() . '.' . $this->media->getClientOriginalExtension();

    //         // Correct way to store with a specific name
    //         $path = $this->media->storeAs('images', $imageName, 'public'); // Saves in storage/app/public/images
    //         $status->update(['avatar' => $imageName]);

    //         $this->reset('media');
    //     }
    // }

    public function avatarDelete()
    {
        dd('sdfasd');
    }
    public function render()
    {

        return view('livewire.edit-profile');
    }
}
