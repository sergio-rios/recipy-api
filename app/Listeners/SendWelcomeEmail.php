<?php

namespace App\Listeners;

use App\Mail\UserWelcome;
use App\Events\UserWasRegistered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeEmail
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserWasRegistered $event)
    {
        $user = $event->user;
        retry(5, function() use ($user) {
            Mail::to($user->email)->send(new UserWelcome($user));
        }, 150);
    }
}
