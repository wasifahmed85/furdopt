<?php


use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

// Artisan::command('inspire', function () {
//     $this->comment(Inspiring::quote());
// })->purpose('Display an inspiring quote')->hourly();

// Schedule::command('petmatch:cron')->everyMinute();
Schedule::command('newchatmail:cron')->everyFiveMinutes();
Schedule::command('test:cron')->everyMinute();
Schedule::command('petpendingNotification:cron')->everyThirtyMinutes();
// Schedule::command('subscriptionstart:cron')->hourly();
// Schedule::command('subscriptionrenewal:cron')->daily();
// Schedule::command('subscriptionexpiry:cron')->daily();

// Schedule::command('orderconfirmationmail:cron')->everyTenMinutes();
// Schedule::command('spotlightpurchaseinvoicemail:cron')->everyMinute();

