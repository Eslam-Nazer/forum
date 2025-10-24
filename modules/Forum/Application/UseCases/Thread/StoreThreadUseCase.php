<?php

namespace Modules\Forum\Application\UseCases\Thread;

use Exception;
use Modules\Forum\Application\DTOs\Thread\CreateThreadDto;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Thread\CreateThreadRepositoryInterface;
use Modules\Forum\Domain\Services\Spam\Spam;

class StoreThreadUseCase
{
    public function __construct(
        protected CreateThreadRepositoryInterface $createThreadRepository,
        protected Spam $spam,
    ) {}

    /**
     * @param CreateThreadDto $dto
     * @return Thread
     * @throws Exception
     */
    public function execute(CreateThreadDto $dto): Thread
    {
        $this->spam->detect($dto->title);
        $this->spam->detect($dto->body);
        return $this->createThreadRepository->handle($dto->userId, $dto->channelId, $dto->title, $dto->body);
    }
}
