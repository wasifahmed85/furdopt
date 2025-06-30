<?php

namespace App\Livewire;

use App\Models\Country;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Component;

class PrivacyPolicy extends Component
{

    #[Title(' About Us')]
    #[Layout('components.layouts.frontend')]

    public function render()
    {

        return view('livewire.privacy-policy');
    }
}
