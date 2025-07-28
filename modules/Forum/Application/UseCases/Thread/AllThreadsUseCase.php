<?php

namespace Modules\Forum\Application\UseCases\Thread;

use Illuminate\Support\Collection;
use Modules\Forum\Domain\Repositories\Thread\AllThreadsRepositoryInterface;

class AllThreadsUseCase
{
    public function __construct(
        protected AllThreadsRepositoryInterface $allThreadsRepository
    )
    {
    }

    public function execute(): Collection
    {
        return $this->allThreadsRepository->handle();
    }

}
