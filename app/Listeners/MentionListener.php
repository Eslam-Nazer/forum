<?php

namespace App\Listeners;

use App\Events\MentionUserEvent;
use App\Models\User;
use App\Notifications\YouWereMentioned;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MentionListener
{
    /**
     * Handle the event.
     */
    public function handle(MentionUserEvent $event): void
    {
        User::query()
            ->whereIn('slug', $event->reply->mentionedUsers())
            ->get()
            ->each
            ->notify(new YouWereMentioned($event->reply));
    }
}
