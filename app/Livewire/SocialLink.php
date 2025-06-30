<?php

namespace App\Livewire;

use App\Models\SocialLink as ModelsSocialLink;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class SocialLink extends Component
{
    #[Title(' Social Link')]

    public $facebook;
    public $google;
    public $phone;
    public $email;

    public function mount()
    {
        $social = ModelsSocialLink::where('user_id', auth()->user()->id)->first();
        if ($social) {
            $this->facebook = $social->facebook;
            $this->google = $social->google;
            $this->phone = $social->phone;
            $this->email = $social->email;
        }
    }

    public function updateData()
    {

        ModelsSocialLink::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
            ],
            [

                'facebook' => $this->facebook,
                'google' => $this->google,

            ]
        );
    }

    public function render()
    {
        return view('livewire.social-link');
    }
}
