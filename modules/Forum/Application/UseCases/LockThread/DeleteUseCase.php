<?php

namespace Modules\Forum\Application\UseCases\LockThread;

use Modules\Forum\Domain\Repositories\Thread\FindThreadRepositoryInterface;

class DeleteUseCase
{
    public function __construct(
        protected FindThreadRepositoryInterface $findThreadRepository,
    ) {}

    /**
     * Execute thread unlock to adding replies
     * @param string $slug
     * @return void
     */
    public function execute(string $slug): void
    {
        $thread = $this->findThreadRepository->handle(slug: $slug);

        abort_if(!$thread, 404);
        $thread->unlock();
    }
}
