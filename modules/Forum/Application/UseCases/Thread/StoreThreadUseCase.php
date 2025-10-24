<?php

namespace Modules\Forum\Application\UseCases\Thread;

use Modules\Forum\Application\DTOs\Thread\CreateThreadDto;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Thread\CreateThreadRepositoryInterface;

class StoreThreadUseCase
{
    public function __construct(
        protected CreateThreadRepositoryInterface $createThreadRepository,
    ) {}

    /**
     * @param CreateThreadDto $dto
     * @return Thread
     */
    public function execute(CreateThreadDto $dto): Thread
    {
        return $this->createThreadRepository->handle($dto->userId, $dto->channelId, $dto->title, $dto->body);
    }
}
