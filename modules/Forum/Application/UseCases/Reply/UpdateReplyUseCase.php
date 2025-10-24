<?php

namespace Modules\Forum\Application\UseCases\Reply;

use Illuminate\Support\Facades\Gate;
use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Domain\Repositories\Reply\FindReplyRepositoryInterface;

class UpdateReplyUseCase
{
    public function __construct(
        protected FindReplyRepositoryInterface $findReplyRepository,
    ){}

    /**
     * @param string $id
     * @return Reply
     */
    public function execute(string $id): Reply
    {
        $reply = $this->findReplyRepository->handle($id);

        Gate::authorize('update', $reply);

        if(!$reply) {
            abort(404);
        }
        $reply->update(['body' => request()->post('body')]);

        return $reply;
    }
}
