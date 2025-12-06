<?php

namespace Modules\Forum\Application\UseCases\Thread;

use JsonException;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Thread\FindThreadRepositoryInterface;
use Modules\Forum\Infrastructure\Cache\Trending;

class ShowThreadUseCase
{
    public function __construct(
        protected FindThreadRepositoryInterface $findThreadRepository,
        protected Trending $trending,
    ) {}

    /**
     * @throws JsonException
     */
    public function execute(string $thread_id, string $channel): Thread|null
    {
        $thread = $this->findThreadRepository->handle($thread_id, $channel);
        if (!$thread) {
            abort(404);
        }
        auth()->user()->read($thread);

        $this->trending->push($thread);
        $thread->recordVisits();

        return $thread;
    }
}
