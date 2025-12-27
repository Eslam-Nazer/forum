<?php

namespace Modules\Forum\Application\UseCases\ThreadSubscription;

use Modules\Forum\Application\DTOs\Thread\FindThreadDto;
use Modules\Forum\Domain\Repositories\Thread\FindThreadRepositoryInterface;

class SubscribeThreadUseCase
{
    public function __construct(
        public FindThreadRepositoryInterface $repository,
    ) {}

    public function execute(FindThreadDto $dto): void
    {
        $thread = $this->repository->handle(slug: $dto->slug, channel: $dto->channelSlug);
        abort_if(!$thread, 404);
        abort_if($thread->is_subscribed, 403);
        $thread->subscribe();
    }
}
