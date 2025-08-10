<?php

namespace Modules\Forum\Infrastructure\Repositories\Reply;

use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Reply\UserAddReplyInThreadRepositoryInterface;

class UserAddReplyInThreadRepository implements UserAddReplyInThreadRepositoryInterface
{
    /**
     * @param string $threadId
     * @param string $userId
     * @param string $body
     * @return Thread
     */
    public function handle(string $threadId, string $userId, string $body): Thread
    {
        $thread = Thread::query()
            ->find($threadId);
        if ($thread) {
            $thread->addReply(['body' => $body, 'user_id' => $userId]);
        }
        return $thread;
    }
}
