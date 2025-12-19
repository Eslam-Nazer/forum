<?php

namespace Modules\Forum\Application\UseCases\Thread;

use Illuminate\Support\Facades\Gate;
use Modules\Forum\Application\DTOs\Thread\DeleteThreadDto;
use Modules\Forum\Domain\Repositories\Thread\FindThreadRepositoryInterface;
use Modules\Forum\Infrastructure\Cache\Trending;

readonly class DeleteThreadUseCase
{
    public function __construct(
        private FindThreadRepositoryInterface $findThreadRepository,
        private Trending $trending
    ) {}

    public function execute(DeleteThreadDto $dto): void
    {
        $thread = $this->findThreadRepository->handle($dto->slug, $dto->channel);
        abort_if(!$thread, 404);

        $this->trending->delete($thread);

        Gate::authorize('delete', $thread);

        $thread->delete();
    }
}
