<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\PushNotification as ModelPushNotification;
use Illuminate\Support\Facades\Auth;

class PushNotification extends Component
{
    #[Title(' Push Notification')]


    public $statuses = [
        'visible_status' => 0,
        'visible_status' => 0,
        'visible_status' => 0,
        'new_message_status' => 0,
        'new_visitor_status' => 0,
        'like_status' => 0,
        'match_status' => 0,
    ];

    public $allStatusesEnabled = false;
    public function mount()
    {



        $notification = ModelPushNotification::where('user_id', Auth::user()->id)->first();

        if ($notification) {
            $this->statuses['visible_status'] = $notification->visible_status;
            $this->statuses['new_message_status'] = $notification->new_message_status;
            $this->statuses['new_visitor_status'] = $notification->new_visitor_status;
            $this->statuses['like_status'] = $notification->like_status;
            $this->statuses['match_status'] = $notification->match_status;
        }

        $this->allStatusesEnabled = collect($this->statuses)->every(fn($status) => $status == 1);
    }

    public function togglePushNotificationAll()
    {

        // $check = ModelPushNotification::where('user_id', Auth::user()->id)->first();
        // if ($check) {
        //     if ($check->visible_status == 1) {
        //         $check->update([
        //             'visible_status' => 0,
        //             'new_message_status' => 0,
        //             'new_visitor_status' => 0,
        //             'like_status' => 0,
        //             'match_status' => 0,
        //         ]);
        //     } else {
        //         $check->update([
        //             'visible_status' => 1,
        //             'new_message_status' => 1,
        //             'new_visitor_status' => 1,
        //             'like_status' => 1,
        //             'match_status' => 1,
        //         ]);
        //     }
        // } else {
        //     ModelPushNotification::create([
        //        'user_id' => Auth::user()->id,
        //         'visible_status' =>1,
        //         'new_message_status' =>1,
        //         'new_visitor_status' =>1,
        //         'like_status' =>1,
        //         'match_status' =>1,
        //     ]);
        // }

        $notification = ModelPushNotification::firstOrCreate(
            ['user_id' => Auth::user()->id],
            [
                'visible_status' => 0,
                'new_message_status' => 0,
                'new_visitor_status' => 0,
                'like_status' => 0,
                'match_status' => 0,
            ]
        );


        $notification->update([
            'visible_status' => 1,
            'new_message_status' => 1,
            'new_visitor_status' => 1,
            'like_status' => 1,
            'match_status' => 1,
        ]);


        $this->statuses = [
            'visible_status' => 1,
            'new_message_status' => 1,
            'new_visitor_status' => 1,
            'like_status' => 1,
            'match_status' => 1,
        ];
    }
    public function toggleAllStatuses()
    {
        $this->allStatusesEnabled = !$this->allStatusesEnabled;


        foreach ($this->statuses as $key => $value) {
            $this->statuses[$key] = $this->allStatusesEnabled ? 1 : 0;
        }

        ModelPushNotification::updateOrCreate(
            ['user_id' => Auth::user()->id],
            $this->statuses
        );
    }

    public function toggleStatus($statusKey)
    {
        $this->statuses[$statusKey] = !$this->statuses[$statusKey];

        ModelPushNotification::updateOrCreate(
            ['user_id' => Auth::user()->id],
            $this->statuses
        );

        $this->allStatusesEnabled = collect($this->statuses)->every(fn($status) => $status == 1);
    }


    public function checkAllStatuses()
    {
        $notification = ModelPushNotification::where('user_id', Auth::user()->id)->first();

        if ($notification) {
            return $notification->visible_status
                && $notification->new_message_status
                && $notification->new_visitor_status
                && $notification->like_status
                && $notification->match_status;
        }

        return false; // Return false if no notification record exists.
    }

    public function render()
    {
        return view('livewire.push-notification');
    }
}
