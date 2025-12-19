<?php

namespace Modules\Forum\Application\UseCases\Reply;

use App\Events\ThreadHasNewReply;
use Modules\Forum\Application\DTOs\Reply\StoreReplyDto;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Reply\StoreReplyRepositoryInterface;

class StoreReplyUseCase
{
    public function __construct(
        protected StoreReplyRepositoryInterface $storeReplyRepository,
    ) {}

    /**
     * Execute reply query creation use case
     *
     * @param StoreReplyDto $dto
     * @return Thread
     */
    public function execute(StoreReplyDto $dto): Thread
    {
        $reply = $this->storeReplyRepository->handle($dto->threadSlug, $dto->userId, $dto->body);

        event(new ThreadHasNewReply($reply));

        return $reply->thread;
    }
}
