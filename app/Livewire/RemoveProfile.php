<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class RemoveProfile extends Component
{
    #[Title(' Subscription')]
    public function render()
    {
        return view('livewire.remove-profile');
    }
}
