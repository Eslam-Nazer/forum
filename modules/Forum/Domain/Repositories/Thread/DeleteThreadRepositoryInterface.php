<?php

namespace Modules\Forum\Domain\Repositories\Thread;

interface DeleteThreadRepositoryInterface
{
    public function handle(string $channel, string $id): void;
}
