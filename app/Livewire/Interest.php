<?php

namespace App\Livewire;

use App\Models\UserDetail;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class Interest extends Component
{
    #[Title(' Interest')]

    public $hobies = [];

    public function mount()
    {

        $detail = UserDetail::where('user_id', Auth::user()->id)->first();

        $this->hobies = $detail && $detail->hobies ? json_decode($detail->hobies, true) : [];
    }

    public function updateData()
    {

        UserDetail::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
            ],
            ['hobies' => json_encode($this->hobies)]
        );

        $this->mount();
    }
    public function render()
    {
        return view('livewire.interest');
    }
}
