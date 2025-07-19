<?php

namespace Modules\Forum\Application\DTOs\Reply;

use Modules\Forum\Domain\Models\Thread;

class UserAddReplyInThreadDto
{
    public function __construct(
        public readonly Thread $thread,
        public readonly string $userId,
        public readonly string $body,
    ){}
}
