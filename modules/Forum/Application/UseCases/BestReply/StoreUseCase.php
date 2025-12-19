<?php

namespace Modules\Forum\Application\UseCases\BestReply;

use Illuminate\Support\Facades\Gate;
use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Domain\Repositories\Reply\FindReplyRepositoryInterface;

class StoreUseCase
{
    public function __construct(
        protected FindReplyRepositoryInterface $findReplyRepository
    ) {}

    public function execute(string $id): Reply
    {
        $reply = $this->findReplyRepository->handle($id);

        abort_if(!$reply, 404);

        Gate::authorize('update', $reply->thread);

        $reply->thread->update(['best_reply_id' => $reply->id]);

        return $reply;
    }
}
