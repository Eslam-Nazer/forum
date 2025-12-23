<?php

namespace Modules\Forum\Infrastructure\Repositories\Reply;

use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Reply\StoreReplyRepositoryInterface;
use Modules\Forum\Domain\Repositories\Thread\FindThreadRepositoryInterface;

class StoreReplyRepository implements StoreReplyRepositoryInterface
{
    /**
     * @param Thread $thread
     * @param string $userId
     * @param string $body
     * @return Reply
     */
    public function handle(Thread $thread, string $userId, string $body): Reply
    {
        return Reply::query()
            ->create([
                "thread_id" => $thread->id,
                "user_id" => $userId,
                "body" => $body
            ]);
    }
}
