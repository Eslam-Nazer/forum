<?php

namespace Modules\Forum\Domain\Repositories\Reply;

use Modules\Forum\Domain\Models\Thread;

interface UserAddReplyInThreadRepositoryInterface
{
    public function handle(string $threadId, string $userId, string $body): Thread;
}
