<?php

namespace Modules\Forum\Domain\Repositories\Reply;

use Modules\Forum\Domain\Models\Thread;

interface UserAddReplyInThreadInterface
{
    public function handle(Thread $thread,string $userId, string $body): void;
}
