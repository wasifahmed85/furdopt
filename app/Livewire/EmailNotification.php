<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Auth;
use App\Models\EmailNotification as ModelsEmailNotification;

class EmailNotification extends Component
{
    #[Title(' Subscription')]
    public $statuses = [
        'verification_status'=>0,
        'new_message_status'=>0,
        'new_visitor_status'=>0,
        'like_status'=>0,
        'match_status'=>0,
        'promotion_status'=>0,
    ];
    public $allStatusesEnabled = false;
    public function mount()
    {


        $notification = ModelsEmailNotification::where('user_id', Auth::user()->id)->first();

        if ($notification) {
            $this->statuses['verification_status'] = $notification->verification_status;
            $this->statuses['new_message_status'] = $notification->new_message_status;
            $this->statuses['new_visitor_status'] = $notification->new_visitor_status;
            $this->statuses['like_status'] = $notification->like_status;
            $this->statuses['match_status'] = $notification->match_status;
            $this->statuses['promotion_status'] = $notification->promotion_status;
        }

        $this->allStatusesEnabled = collect($this->statuses)->every(fn($status) => $status == 1);
    }

    public function toggleStatus($statusKey)
{
    $this->statuses[$statusKey] = !$this->statuses[$statusKey];

    ModelsEmailNotification::updateOrCreate(
        ['user_id' => Auth::user()->id],
        $this->statuses
    );

    $this->allStatusesEnabled = collect($this->statuses)->every(fn($status) => $status == 1);
}

    public function render()
    {
        return view('livewire.email-notification');
    }
}
