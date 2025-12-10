<?php

namespace App\Listeners;

use App\Mail\PleaseConfirmYourEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailConfirmationRequest
{
    public function handle(Registered $event): void
    {
        Mail::to($event->user)->send(new PleaseConfirmYourEmail());
    }
}
