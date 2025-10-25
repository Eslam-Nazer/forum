<?php

namespace Modules\Forum\Infrastructure\Repositories\Reply;

use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Domain\Repositories\Reply\StoreReplyRepositoryInterface;

class StoreReplyRepository implements StoreReplyRepositoryInterface
{
    /**
     * @param string $threadId
     * @param string $userId
     * @param string $body
     * @return Reply
     */
    public function handle(string $threadId, string $userId, string $body): Reply
    {
        return Reply::query()
            ->create([
                "thread_id" => $threadId,
                "user_id" => $userId,
                "body" => $body
            ]);
    }
}
