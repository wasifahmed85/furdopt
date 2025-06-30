<?php

namespace App\Console\Commands;

use App\Mail\SpotlightPurchaseInvoice;

use App\Models\User;

use Carbon\Carbon;
use Mail;

use App\Mail\WelcomeEmail;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Console\Command;

class SpotlightPurchaseInvoiceMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spotlightpurchaseinvoicemail:cron';

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
        // $cutoffTime = Carbon::now()->subMinutes(30);

        // $payments = Payment::where('created_at', '>=', $cutoffTime)->get();
        // foreach ($payments as $payment) {
        //     $user = $payment->user;
        //     $subcription = $payment->subcription;
        //     Mail::to($user->email)->send(new SpotlightPurchaseInvoice($user, $payment,$subcription ));
        // }

        $cutoffTime = Carbon::now()->subMinutes(30);

$payments = Payment::where('created_at', '>=', $cutoffTime)->get();

foreach ($payments as $payment) {
    $user = $payment->user ?? null;
    $subscription = $payment->subcription ?? null;

    if ($user && $subscription) {
        Mail::to($user->email)->send(new SpotlightPurchaseInvoice($user, $subscription, $payment));
    }
}

        \Log::info('test cron job running invoice start');
        $this->info('Emails sent for unseen messages in the last 20 minutes.');
    }
}
