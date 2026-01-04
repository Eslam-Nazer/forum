<?php

namespace Modules\Forum\Application\UseCases\Thread;

use Illuminate\Http\Request;
use Modules\Forum\Application\DTOs\Thread\FindThreadDto;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Thread\FindThreadRepositoryInterface;

readonly class UpdateThreadUseCase
{
    public function __construct(
        private FindThreadRepositoryInterface $threadRepository,
    ) {}

    public function execute(FindThreadDto $dto, Request $request): Thread
    {
        $thread = $this->threadRepository->handle(slug: $dto->slug, channel: $dto->channelSlug);

        $thread?->update((array) $request->validated());

        return $thread;
    }
}
