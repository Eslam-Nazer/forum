<?php

namespace Modules\Forum\Domain\Repositories\Thread;

use Modules\Forum\Domain\Models\Thread;

interface CreateThreadRepositoryInterface
{
    public function handle(string $userId, string $channelId,string $title, string $body): Thread;
}
