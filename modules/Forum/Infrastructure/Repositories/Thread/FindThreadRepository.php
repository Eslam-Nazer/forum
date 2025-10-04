<?php

namespace Modules\Forum\Infrastructure\Repositories\Thread;

use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Thread\FindThreadRepositoryInterface;

class FindThreadRepository implements FindThreadRepositoryInterface
{
    public function handle(string $thread_id, string $channel): Thread|null
    {
        return Thread::query()
            ->where('id', '=', $thread_id)
            ->whereRelation('channel', 'slug', '=', $channel)
            ->first();
    }
}
