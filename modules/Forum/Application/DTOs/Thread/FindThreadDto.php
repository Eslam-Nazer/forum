<?php

namespace Modules\Forum\Application\DTOs\Thread;

class FindThreadDto
{
    public function __construct(
        public string $channelId,
        public string $id,
    ) {}
}
