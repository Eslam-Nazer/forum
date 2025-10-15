<?php

namespace Modules\Forum\Application\DTOs\Thread;

readonly class AllThreadsFilteredDto
{
    public function __construct(
        public string|null $channel = null,
    ) {}
}
