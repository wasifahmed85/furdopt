<?php

namespace App\Listeners;

use App\Mail\WelcomeEmail;
use App\Models\User;
use App\Mail\NewSignUpEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Verified;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeEmail
{
    public function handle(Verified $event)
    {
        $user = $event->user;
        Mail::to($user->email)->send(new WelcomeEmail($user));
        $users = User::where('role_id',4)->get(['id','email']);
        
            foreach ($users as $us)
            {
                 Mail::to($us->email)->send(new NewSignUpEmail($user));
            }
        
        // if (! $user->welcome_email_sent) {
        //     Mail::to($user->email)->send(new WelcomeEmail($user));


        //     $user->welcome_email_sent = 1;
        //     $user->save();
        // }
        // info("welcome mail info ". now());
    }
}
