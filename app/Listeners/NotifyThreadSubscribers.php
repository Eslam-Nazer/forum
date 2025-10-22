<?php

namespace App\Listeners;

use App\Events\ThreadHasNewReply;
use App\Notifications\ThreadWasUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyThreadSubscribers
{
    /**
     * Handle the event.
     */
    public function handle(ThreadHasNewReply $event): void
    {
        $event->thread->subscriptions()
            ->where('user_id', '!=', $event->reply->user_id)
            ->get()
            ->each->notify(new ThreadWasUpdated($event->thread, $event->reply));
    }
}
