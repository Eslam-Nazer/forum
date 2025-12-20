<?php

namespace Modules\Forum\Application\UseCases\Reply;

use Illuminate\Support\Facades\Gate;
use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Domain\Repositories\Reply\FindReplyRepositoryInterface;

class DeleteReplyUseCase
{
    public function __construct(
        protected FindReplyRepositoryInterface $findReplyRepository
    )
    {}

    public function execute(string $id): void
    {
        $reply = $this->findReplyRepository->handle($id);

        abort_if(!$reply, 404);
        Gate::authorize('delete', $reply);

        $reply?->delete();
    }
}
