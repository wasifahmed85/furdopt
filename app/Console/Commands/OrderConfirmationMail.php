<?php

namespace App\Console\Commands;

use App\Mail\OrderConfirmationNotification;
use App\Mail\SubscriptionStartNotificatiton;
use App\Models\User;

use Carbon\Carbon;
use Mail;
use App\Mail\UnseenMessageNotificationMail;
use App\Mail\WelcomeEmail;
use App\Models\Subscription;
use Illuminate\Console\Command;

class OrderConfirmationMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orderconfirmationmail:cron';

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
        $cutoffTime = Carbon::now()->subMinutes(50);

        $subscriptions = Subscription::where('created_at', '>=', $cutoffTime)->get();
        foreach ($subscriptions as $subscription) {
            $user = $subscription->user;
            Mail::to($user->email)->send(new OrderConfirmationNotification($user, $subscription));
        }


        \Log::info('test cron job running subscription start');
        $this->info('Emails sent for unseen messages in the last 20 minutes.');
    }
}
