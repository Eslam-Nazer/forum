<?php

namespace Modules\Forum\Infrastructure\Repositories\Thread;

use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Thread\FindThreadRepositoryInterface;

class FindThreadRepository implements FindThreadRepositoryInterface
{
    public function handle(string $slug, string $channel): Thread|null
    {
        return Thread::query()
            ->where('slug', '=', $slug)
            ->whereRelation('channel', 'slug', '=', $channel)
            ->firstOrFail();
    }
}
