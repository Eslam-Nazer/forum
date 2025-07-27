<?php

namespace Modules\Forum\Infrastructure\Repositories\Thread;

use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Thread\CreateThreadRepositoryInterface;

class CreateThreadRepository implements CreateThreadRepositoryInterface
{
    public function handle(string $userId, string $channelId, string $title, string $body): Thread
    {
        return Thread::create([
            "user_id" => $userId,
            "channel_id" => $channelId,
            "title" => $title,
            "body" => $body
        ]);
    }
}
