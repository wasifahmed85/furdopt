<?php

namespace App\Console\Commands;

use Mail;
use Carbon\Carbon;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Console\Command;
use App\Mail\PetPendingNotificationMail;

class PetPendingNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'petpendingNotification:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cutoffTime = Carbon::now()->subMinutes(20);


    $pets = Pet::where('isPublished',0)->where('created_at', '>=', $cutoffTime)->get(['id','name','slug']);
    $users = User::where('role_id',4)->get(['id','email']);
    foreach ($users as $user) {
            if(count($pets) > 0)
            {
                Mail::to($user->email)->send(new PetPendingNotificationMail($pets));
            }
            

    }

    $this->info('Emails sent for pending list in the last 30 minutes.');
    info("Cron Job running at pet pending list ". now());


    }
}
