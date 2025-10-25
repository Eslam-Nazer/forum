<?php

namespace Modules\Forum\Application\UseCases\Reply;

use Illuminate\Support\Facades\Gate;
use Modules\Forum\Application\DTOs\Reply\UserAddReplyInThreadDto;
use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Reply\StoreReplyRepositoryInterface;

class StoreReplyUseCase
{
    public function __construct(
        protected StoreReplyRepositoryInterface $storeReplyRepository,
    ) {}

    /**
     * @param UserAddReplyInThreadDto $dto
     * @return Thread
     */
    public function execute(UserAddReplyInThreadDto $dto): Thread
    {
        Gate::authorize('create', Reply::class);

        $reply = $this->storeReplyRepository->handle($dto->threadId, $dto->userId, $dto->body);
        return $reply->thread;
    }
}
