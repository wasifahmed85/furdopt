<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ProfileVisible;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;

class ProfileVisibility extends Component
{
    #[Title(' Subscription')]

    public $statuses = [
        'profile_visible_status'=>0,
        'profile_online_status'=>0,
    ];
    public $allStatusesEnabled = false;
    public function mount()
    {


        $notification = ProfileVisible::where('user_id', Auth::user()->id)->first();

        if ($notification) {
            $this->statuses['profile_visible_status'] = $notification->profile_visible_status;
            $this->statuses['profile_online_status'] = $notification->profile_online_status;
        }

        $this->allStatusesEnabled = collect($this->statuses)->every(fn($status) => $status == 1);
    }

    public function toggleStatus($statusKey)
    {
        $this->statuses[$statusKey] = !$this->statuses[$statusKey];

        ProfileVisible::updateOrCreate(
            ['user_id' => Auth::user()->id],
            $this->statuses
        );

        $this->allStatusesEnabled = collect($this->statuses)->every(fn($status) => $status == 1);
    }

    public function render()
    {
        return view('livewire.profile-visibility');
    }
}
