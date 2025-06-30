<?php

namespace App\Livewire;

use App\Models\PetLike;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

class Activity extends Component
{
    #[Title(' Activities')]
    public $likeMe;
    public $youLikes;
    public function render()
    {
        $this->likeMe = PetLike::where('owner_id', Auth::user()->id)->get();
        $this->youLikes = PetLike::where('user_id', Auth::user()->id)->get();
        
        return view('livewire.activity');
    }
}
