<?php

namespace App\Livewire;

use App\Models\Country;
use App\Models\Page as ModelsPage;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Page extends Component
{

    #[Title(' Page')]
    #[Layout('components.layouts.frontend')]
    public $page;
    public function mount($slug)
    {

        if (!empty($slug)) {
            $this->page = ModelsPage::where('slug', $slug)->first();
        } else {
            return $this->redirect('/');
        }
    }

    public function render()
    {

        return view('livewire.page');
    }
}
