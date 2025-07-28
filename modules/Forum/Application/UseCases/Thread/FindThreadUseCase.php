<?php

namespace Modules\Forum\Application\UseCases\Thread;

use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Thread\FindThreadRepositoryInterface;

class FindThreadUseCase
{
    public function __construct(
        protected FindThreadRepositoryInterface $findThreadRepository,
    )
    {
    }

    public function execute(string $thread_id): Thread|null
    {
        return $this->findThreadRepository->handle($thread_id);
    }
}
