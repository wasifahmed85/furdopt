<?php

namespace App\Console\Commands;

use App\Mail\SubscriptionRenewalNotification;
use App\Mail\SubscriptionStartNotificatiton;
use App\Models\User;

use Carbon\Carbon;
use Mail;
use App\Mail\UnseenMessageNotificationMail;
use App\Mail\WelcomeEmail;
use App\Models\Subscription;
use Illuminate\Console\Command;

class SubscriptionRenewalMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptionrenewal:cron';

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
        // $reminderDate = Carbon::now()->addDays(3)->startOfDay();
        $reminderDate = Carbon::now()->addDays(3)->toDateString();
        $expiringSubscriptions = Subscription::whereDate('end_date', $reminderDate)->get();
        foreach ($expiringSubscriptions as $subscription) {
            // Mail::to($subscription->user->email)->send(new SubscriptionRenewalNotification($subscription));
            \Log::info('test cron job running subscription renewal');
            $user = $subscription->user;

            if ($user) {
                Mail::to($user->email)->send(new SubscriptionRenewalNotification($user, $subscription));
            }
        }

        \Log::info($reminderDate);
        \Log::info('test cron job running subscription renewal');
    }
}
