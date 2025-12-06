<?php

namespace Modules\Forum\Infrastructure\Repositories\Thread;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\Forum\Domain\Models\Channel;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Thread\AllThreadsRepositoryInterface;
use Modules\Forum\Domain\Repositories\Thread\Filters\FilterThreadsRepositoryInterface;

readonly class AllThreadsRepository implements AllThreadsRepositoryInterface
{
    public function __construct(
        private FilterThreadsRepositoryInterface $filterThreadsRepository,
    )
    {
    }

    /**
     * @param Request $request
     * @param string|null $channel
     * @return Collection|LengthAwarePaginator
     */
    public function handle(Request $request, string|null $channel = null): Collection|LengthAwarePaginator
    {
        $threads = Thread::query()
            ->latest()
            ->orderBy('id');

        if (filled($channel)) {
            $threads->where(
                'channel_id', '=', Channel::query()
                ->where('slug', '=', $channel)
                ->firstOrFail()->id
            );
        }

        $threads = $this->filterThreadsRepository->apply($threads, $request);

        return $threads->paginate(5);
    }
}
