<?php

namespace Modules\Forum\Application\UseCases\ThreadSubscription;

use Modules\Forum\Application\DTOs\Thread\FindThreadDto;
use Modules\Forum\Domain\Repositories\Thread\FindThreadRepositoryInterface;

class SubscribeThreadUseCase
{
    public function __construct(
        public FindThreadRepositoryInterface $repository,
    ) {}

    public function execute(FindThreadDto $dto)
    {
        $thread = $this->repository->handle($dto->id, $dto->channelId);
        $thread->subscribe();
    }
}
