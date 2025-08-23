<?php

namespace Modules\Forum\Application\UseCases\Thread;

use Modules\Forum\Application\DTOs\Thread\DeleteThreadDto;
use Modules\Forum\Domain\Repositories\Thread\DeleteThreadRepositoryInterface;

readonly class DeleteThreadUseCase
{
    public function __construct(
        private DeleteThreadRepositoryInterface $deleteThreadRepository,
    )
    {}

    public function execute(DeleteThreadDto $dto): void
    {
        $this->deleteThreadRepository->handle($dto->channel, $dto->id);
    }
}
