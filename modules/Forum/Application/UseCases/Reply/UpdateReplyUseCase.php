<?php

namespace Modules\Forum\Application\UseCases\Reply;

use Exception;
use Illuminate\Support\Facades\Gate;
use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Domain\Repositories\Reply\FindReplyRepositoryInterface;
use Modules\Forum\Domain\Services\Spam\Spam;

class UpdateReplyUseCase
{
    public function __construct(
        protected FindReplyRepositoryInterface $findReplyRepository,
        protected Spam $spam,
    ){}

    /**
     * @param string $id
     * @return Reply
     * @throws Exception
     */
    public function execute(string $id): Reply
    {
        $reply = $this->findReplyRepository->handle($id);

        Gate::authorize('update', $reply);

        if(!$reply) {
            abort(404);
        }
        $this->spam->detect(request()->post('body'));
        $reply->update(['body' => request()->post('body')]);

        return $reply;
    }
}
