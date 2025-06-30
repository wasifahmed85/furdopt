<?php

namespace App\Console\Commands;

use App\Mail\SubscriptionExpiryNotification;
use App\Mail\SubscriptionRenewalNotification;
use App\Mail\SubscriptionStartNotificatiton;
use App\Models\User;

use Carbon\Carbon;
use Mail;
use App\Mail\UnseenMessageNotificationMail;
use App\Mail\WelcomeEmail;
use App\Models\Subscription;
use Illuminate\Console\Command;

class SubscriptionExpiryMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptionexpiry:cron';

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
        // $expiredSubscriptions = Subscription::whereDate('end_date', Carbon::now()->subDay()->toDateString())->get();
        $expiredSubscriptions = Subscription::whereDate('end_date', '<', Carbon::today())->get();

        foreach ($expiredSubscriptions as $subscription) {
            $user = $subscription->user;
            if ($user) {
                Mail::to($user->email)->send(new SubscriptionExpiryNotification($user, $subscription));
            }
        }
        \Log::info('test cron job running subscription expired');
    }
}
