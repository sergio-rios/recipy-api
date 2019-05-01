<?php

namespace App\Listeners;

use App\Mail\UserVerify;
use App\Mail\UserWelcome;
use App\Events\UserEmailHasChanged;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailVerification
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserEmailHasChanged $event)
    {
        $user = $event->user;
        retry(5, function() use ($user) {
            Mail::to($user->email)->send(new UserVerify($user));
        }, 150);
    }
}
