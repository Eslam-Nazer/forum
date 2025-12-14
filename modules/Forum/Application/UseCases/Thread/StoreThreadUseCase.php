<?php

namespace Modules\Forum\Application\UseCases\Thread;

use Illuminate\Support\Str;
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
        return $this->createThreadRepository->handle()->create([
            'title' => $dto->title,
            'body' => $dto->body,
            'user_id' => $dto->userId,
            'channel_id' => $dto->channelId,
            'slug' => Str::slug($dto->title)
        ]);
    }
}
