<?php

namespace Modules\Forum\Infrastructure\Repositories\Thread;

use Illuminate\Database\Eloquent\Builder;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Thread\FindThreadRepositoryInterface;

class FindThreadRepository implements FindThreadRepositoryInterface
{
    public function handle(string $slug, ?string $channel = null): Thread|null
    {
        return Thread::query()
            ->where('slug', '=', $slug)
            ->when($channel, function (Builder $query) use ($channel) {
                $query->whereRelation('channel', 'slug', '=', $channel);
            })
            ->with(['creator', 'replies', 'favorites'])
            ->firstOrFail();
    }
}
