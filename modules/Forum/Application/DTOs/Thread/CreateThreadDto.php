<?php

namespace Modules\Forum\Application\DTOs\Thread;

class CreateThreadDto
{
    public function __construct(
        public string $userId,
        public string $channelId,
        public readonly string $title,
        public readonly string $body,
    ){}
}
