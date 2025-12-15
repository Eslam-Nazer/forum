<?php

namespace Modules\Forum\Application\DTOs\Thread;

class DeleteThreadDto
{
    public function __construct(
        public string $channel,
        public string $slug,
    ) {}
}
