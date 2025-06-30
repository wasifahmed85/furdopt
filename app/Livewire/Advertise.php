<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class Advertise extends Component
{
    #[Layout('components.layouts.frontend')]
    #[Title(' My Pawrent')]
    public function render()
    {
        return view('livewire.advertise');
    }
}
