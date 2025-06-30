<?php

namespace App\Livewire;

use App\Models\Country;
use App\Models\Faq as ModelsFaq;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Faq extends Component
{

    #[Title(' Faq')]
    #[Layout('components.layouts.frontend')]

    public function render()
    {
        $faqs = ModelsFaq::all();
        return view('livewire.faq', [
            'faqs' => $faqs
        ]);
    }
}
