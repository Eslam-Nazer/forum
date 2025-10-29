<?php

namespace App\Listeners;

use App\Events\ThreadHasNewReply;
use App\Models\User;
use App\Notifications\YouWereMentioned;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MentionListener
{
    /**
     * Handle the event.
     */
    public function handle(ThreadHasNewReply $event): void
    {
        $users = User::query()->whereIn('name',  $event->reply->mentionedUsers())->get();
        $users->each->notify(new YouWereMentioned($event->reply));
    }
}
