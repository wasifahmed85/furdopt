<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\UserDetail;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

class Sport extends Component
{
    #[Title(' Sport')]


    public $sports = [];

    public function mount()
    {
        $detail = UserDetail::where('user_id', Auth::id())->first();


        $this->sports = $detail && $detail->sports ? json_decode($detail->sports, true) : [];
    }

    public function updateData()
    {
        UserDetail::updateOrCreate(
            ['user_id' => Auth::id()],
            ['sports' => json_encode($this->sports)]
        );

        session()->flash('message', 'Sports preferences updated successfully!');
    }
    public function render()
    {
        return view('livewire.sport');
    }
}
