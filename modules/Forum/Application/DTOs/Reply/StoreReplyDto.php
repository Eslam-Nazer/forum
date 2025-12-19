<?php

namespace Modules\Forum\Application\DTOs\Reply;

readonly class StoreReplyDto
{
    public function __construct(
        public string $threadSlug,
        public string $userId,
        public string $body,
    ){}
}
