<?php

namespace Modules\Forum\Application\DTOs\Thread;

readonly class ThreadsFilteredDto
{
    public function __construct(
        public string|null $channel = null,
    ) {}
}
