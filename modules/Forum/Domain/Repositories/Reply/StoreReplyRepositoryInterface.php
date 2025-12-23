<?php

namespace Modules\Forum\Domain\Repositories\Reply;

use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Domain\Models\Thread;

interface StoreReplyRepositoryInterface
{
    public function handle(Thread $thread, string $userId, string $body): Reply;
}
