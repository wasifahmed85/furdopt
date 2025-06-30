<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Listeners\SendWelcomeEmail;
use Illuminate\Auth\Events\Verified;


class EventServiceProvider extends ServiceProvider
{

  /**
     * The event to listener mappings for the application.
     */
    protected $listen = [
        Verified::class => [
            SendWelcomeEmail::class,
        ],
    ];


    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        parent::boot();
    }

}
