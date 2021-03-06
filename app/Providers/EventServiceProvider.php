<?php

namespace App\Providers;

use App\Events\UserWasRegistered;
use App\Events\UserEmailHasChanged;
use App\Listeners\SendWelcomeEmail;
use Illuminate\Support\Facades\Event;
use App\Listeners\SendEmailVerification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        UserWasRegistered::class => [
            SendWelcomeEmail::class,
        ],
        UserEmailHasChanged::class => [
            SendEmailVerification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
