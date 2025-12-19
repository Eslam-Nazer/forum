<?php

namespace Modules\Forum\Infrastructure\Repositories\Thread;

use Modules\Forum\Application\DTOs\Thread\StoreThreadDto;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Thread\StoreThreadRepositoryInterface;

class StoreThreadRepository implements StoreThreadRepositoryInterface
{
    public function handle(StoreThreadDto $dto): Thread
    {
        return Thread::query()->create([
            'title' => $dto->title,
            'body' => $dto->body,
            'user_id' => $dto->userId,
            'channel_id' => $dto->channelId,
            'slug' => $dto->title,
        ]);
    }
}
