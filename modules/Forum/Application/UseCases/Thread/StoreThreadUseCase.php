<?php

namespace Modules\Forum\Application\UseCases\Thread;

use Modules\Forum\Application\DTOs\Thread\StoreThreadDto;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Thread\StoreThreadRepositoryInterface;

class StoreThreadUseCase
{
    public function __construct(
        protected StoreThreadRepositoryInterface $storeThreadRepository,
    ) {}

    /**
     * Execute query that make new thread
     *
     * @param StoreThreadDto $dto
     * @return Thread
     */
    public function execute(StoreThreadDto $dto): Thread
    {
        return $this->storeThreadRepository->handle($dto);
    }
}
