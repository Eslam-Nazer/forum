<?php

namespace Modules\Forum\Application\DTOs\Reply;

readonly class UserAddReplyInThreadDto
{
    public function __construct(
        public string $threadId,
        public string $userId,
        public string $body,
    ){}
}
