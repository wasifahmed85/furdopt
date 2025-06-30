<?php

namespace App\Console\Commands;

use App\Models\User;

use Carbon\Carbon;
use Mail;
use App\Mail\UnseenMessageNotificationMail;
use App\Mail\WelcomeEmail;
use Illuminate\Console\Command;

class WelcomeMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'welcomemail:cron';

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


    $users = User::where('created_at', '>=', $cutoffTime)->get(['id','email']);

    foreach ($users as $user) {

            Mail::to($user->email)->send(new WelcomeEmail($user));

    }

    $this->info('Emails sent for unseen messages in the last 20 minutes.');



    }
}
