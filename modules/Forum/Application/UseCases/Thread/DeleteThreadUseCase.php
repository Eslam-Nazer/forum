<?php

namespace Modules\Forum\Application\UseCases\Thread;

use Illuminate\Support\Facades\Gate;
use Modules\Forum\Application\DTOs\Thread\DeleteThreadDto;
use Modules\Forum\Domain\Repositories\Thread\FindThreadRepositoryInterface;

readonly class DeleteThreadUseCase
{
    public function __construct(
        private FindThreadRepositoryInterface $findThreadRepository,
    )
    {
    }

    public function execute(DeleteThreadDto $dto): void
    {
        $thread = $this->findThreadRepository->handle($dto->slug, $dto->channel);
        if ($thread === null) {
            abort(404);
        }

        Gate::authorize('delete', $thread);

        $thread->delete();
    }
}
