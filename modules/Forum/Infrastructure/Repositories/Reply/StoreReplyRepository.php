<?php

namespace Modules\Forum\Infrastructure\Repositories\Reply;

use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Domain\Repositories\Reply\StoreReplyRepositoryInterface;
use Modules\Forum\Domain\Repositories\Thread\FindThreadRepositoryInterface;

class StoreReplyRepository implements StoreReplyRepositoryInterface
{
    public function __construct(
        public FindThreadRepositoryInterface $threadRepository,
    ) {}

    /**
     * @param string $threadSlug
     * @param string $userId
     * @param string $body
     * @return Reply
     */
    public function handle(string $threadSlug, string $userId, string $body): Reply
    {
        return Reply::query()
            ->create([
                "thread_id" => $this->threadRepository->handle($threadSlug)->id,
                "user_id" => $userId,
                "body" => $body
            ]);
    }
}
