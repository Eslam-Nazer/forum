<?php

namespace Modules\Forum\Application\UseCases\ThreadSubscription;

use Modules\Forum\Application\DTOs\Thread\FindThreadDto;
use Modules\Forum\Domain\Repositories\Thread\FindThreadRepositoryInterface;

class UnsubscribeThreadUseCase
{
    public function __construct(
        public FindThreadRepositoryInterface $repository,
    ) {}

    public function execute(FindThreadDto $dto): void
    {
        $thread = $this->repository->handle($dto->id, $dto->channelSlug);
        $thread->unsubscribe();
    }
}
