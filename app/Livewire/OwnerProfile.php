<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\UserDetail;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

class OwnerProfile extends Component
{

    #[Title(' Owner Profile')]
    #[Layout('components.layouts.app')]

    public $owner;
    public $userdetail;

    public function mount($id)
    {
        $this->owner = User::findorfail($id);
        $this->userdetail = UserDetail::where('user_id', $id)->first();
    }
    public function render()
    {
        return view('livewire.owner-profile');
    }
}
