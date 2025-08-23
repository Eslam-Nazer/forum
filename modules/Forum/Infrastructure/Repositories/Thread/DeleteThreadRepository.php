<?php

namespace Modules\Forum\Infrastructure\Repositories\Thread;

use Illuminate\Database\Eloquent\Builder;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Thread\DeleteThreadRepositoryInterface;

class DeleteThreadRepository implements DeleteThreadRepositoryInterface
{
    public function handle(string $channel, string $id): void
    {
        $thread = Thread::query()
            ->whereHas('channel', static function (Builder $query) use ($channel) {
                $query->where('slug', '=', $channel);
            })
            ->where('id', '=', $id)
            ->first();
        if ($thread) {
            $thread->delete();
        }
    }
}
