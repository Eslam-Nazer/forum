<?php

namespace Modules\Forum\Infrastructure\Repositories\Reply;

use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Reply\UserAddReplyInThreadInterface;

class UserAddReplyInThread implements UserAddReplyInThreadInterface
{
    public function handle(Thread $thread,string $userId, string $body): void
    {
        $thread->addReply([
            'user_id' => $userId,
            'body' => $body,
        ]);
    }
}
