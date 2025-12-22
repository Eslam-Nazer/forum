<?php

namespace Modules\Forum\Application\UseCases\BestReply;

use Illuminate\Support\Facades\Gate;
use Modules\Forum\Domain\Repositories\Reply\FindReplyRepositoryInterface;

class DeleteUseCase
{
    public function __construct(
        protected  FindReplyRepositoryInterface $replyRepository,
    ) {}

    public function execute(string $id): bool
    {
        $reply = $this->replyRepository->handle($id);

        abort_if(!$reply, 404);
        Gate::authorize('delete', $reply->thread);

        return $reply->thread()->update(['best_reply_id' => null]);
    }

}
