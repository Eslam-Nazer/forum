<?php

namespace Modules\Forum\Infrastructure\Repositories\Thread;

use Illuminate\Database\Eloquent\Builder;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Channel\FindChannelRepositoryInterface;
use Modules\Forum\Domain\Repositories\Thread\ThreadsRepositoryInterface;

readonly class ThreadsRepository implements ThreadsRepositoryInterface
{
    public function __construct(
        protected FindChannelRepositoryInterface $findChannelRepository,
    ) {}

    /**
     * @param string|null $channel
     * @return Builder
     */
    public function handle(string|null $channel = null): Builder
    {
        $threads = Thread::query()
            ->latest()
            ->with(['creator', 'favorites'])
            ->orderBy('id');

        if (filled($channel)) {
            $threads->where(
                'channel_id', '=', $this->findChannelRepository->handle(channel_slug: $channel)->id
            );
        }

       return $threads;
    }
}
