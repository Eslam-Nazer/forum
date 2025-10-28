<?php

namespace App\Listeners;

use App\Events\MentionEvent;
use App\Notifications\YouWereMentioned;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MentionListener
{
    /**
     * Handle the event.
     */
    public function handle(MentionEvent $event): void
    {
        $event->users->each->notify(new YouWereMentioned($event->reply));
    }
}
