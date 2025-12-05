<?php

namespace Modules\Forum\Application\UseCases\Thread;

use Illuminate\Support\Facades\Redis;
use JsonException;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Thread\FindThreadRepositoryInterface;

class ShowThreadUseCase
{
    public function __construct(
        protected FindThreadRepositoryInterface $findThreadRepository,
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

        Redis::zincrby('trending_threads', 1, json_encode([
            'title' => $thread->title,
            'slug' => $thread->channel->slug,
            'path' => $thread->path()
        ], JSON_THROW_ON_ERROR));

        return $thread;
    }
}
