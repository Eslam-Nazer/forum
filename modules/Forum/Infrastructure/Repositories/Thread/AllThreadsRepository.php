<?php

namespace Modules\Forum\Infrastructure\Repositories\Thread;

use Illuminate\Support\Collection;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Thread\AllThreadsRepositoryInterface;

class AllThreadsRepository implements AllThreadsRepositoryInterface
{
    public function handle(string|null $channel = null): Collection
    {
        $threads = Thread::query();

        if (filled($channel)) {
            $threads->where('channel_id', '=', $channel);
        }

        return $threads->latest()->get();
    }
}
