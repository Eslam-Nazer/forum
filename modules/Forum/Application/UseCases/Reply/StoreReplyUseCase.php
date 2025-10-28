<?php

namespace Modules\Forum\Application\UseCases\Reply;

use App\Events\MentionEvent;
use App\Models\User;
use App\Notifications\YouWereMentioned;
use Illuminate\Support\Facades\Gate;
use Modules\Forum\Application\DTOs\Reply\UserAddReplyInThreadDto;
use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Reply\StoreReplyRepositoryInterface;

class StoreReplyUseCase
{
    public function __construct(
        protected StoreReplyRepositoryInterface $storeReplyRepository,
    )
    {
    }

    /**
     * @param UserAddReplyInThreadDto $dto
     * @return Thread
     */
    public function execute(UserAddReplyInThreadDto $dto): Thread
    {
        $reply = $this->storeReplyRepository->handle($dto->threadId, $dto->userId, $dto->body);

        preg_match_all('/\@([^\s\.]+)/', $reply->body, $matches);

        $users = User::query()->whereIn('name',  $matches[1])->get();

        event(new MentionEvent($reply, $users));

        return $reply->thread;
    }
}
