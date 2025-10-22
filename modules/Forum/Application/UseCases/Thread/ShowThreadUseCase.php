<?php

namespace Modules\Forum\Application\UseCases\Thread;

use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Thread\FindThreadRepositoryInterface;

class ShowThreadUseCase
{
    public function __construct(
        protected FindThreadRepositoryInterface $findThreadRepository,
    ) {}

    public function execute(string $thread_id, string $channel): Thread|null
    {
        $thread = $this->findThreadRepository->handle($thread_id, $channel);
        if (!$thread) {
            abort(404);
        }
        auth()->user()->read($thread);

        return $thread;
    }
}
