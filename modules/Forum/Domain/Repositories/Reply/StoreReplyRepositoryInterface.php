<?php

namespace Modules\Forum\Domain\Repositories\Reply;

use Modules\Forum\Domain\Models\Reply;

interface StoreReplyRepositoryInterface
{
    public function handle(string $threadSlug, string $userId, string $body): Reply;
}
