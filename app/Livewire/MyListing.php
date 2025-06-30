<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class MyListing extends Component
{
    #[Title(' My Listing')]

    public $pets;
    public function render()
    {

        $this->pets = auth()->user()->pets;
        return view('livewire.my-listing');
    }
}
