<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use App\Events\AdminEmailVerificationEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class AdminEmailVerificationListener
{
    /**
     * Create the event listener.
     */

    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(AdminEmailVerificationEvent $event)
    {
        if ($event->admin instanceof MustVerifyEmail && !$event->admin->hasVerifiedEmail()) {
            $event->admin->sendEmailVerificationNotification();
        }
    }
}
