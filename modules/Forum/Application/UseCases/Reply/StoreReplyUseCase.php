<?php

namespace Modules\Forum\Application\UseCases\Reply;

use App\Events\ThreadHasNewReply;
use Modules\Forum\Application\DTOs\Reply\StoreReplyDto;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Reply\StoreReplyRepositoryInterface;
use Modules\Forum\Domain\Repositories\Thread\FindThreadRepositoryInterface;

class StoreReplyUseCase
{
    public function __construct(
        protected StoreReplyRepositoryInterface $storeReplyRepository,
        protected FindThreadRepositoryInterface $findThreadRepository
    ) {}

    /**
     * Execute reply query creation use case
     *
     * @param StoreReplyDto $dto
     * @return Thread
     */
    public function execute(StoreReplyDto $dto): Thread
    {
        $thread = $this->findThreadRepository->handle(slug: $dto->threadSlug);

        abort_if(! $thread, 404);
        abort_if($thread->locked, 422);

        $reply = $this->storeReplyRepository->handle($thread, $dto->userId, $dto->body);

        event(new ThreadHasNewReply($reply));

        return $reply->thread;
    }
}
