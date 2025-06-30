<?php

namespace App\Livewire;

use App\Models\BlockUser;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class BlockedProfile extends Component
{
    #[Title(' Subscription')]

    public $users;
    public $searchTerm;

    public function unblockUser($id)
    {
       
       $data= BlockUser::where('user_id', Auth::id())->where('blocked_user_id', $id)->delete();
       
    }

    public function render()
    {
        $this->users = BlockUser::where('user_id', Auth::id())->search($this->searchTerm)->get();
        return view('livewire.blocked-profile');
    }
}
