<?php

namespace Modules\Forum\Infrastructure\Repositories\Reply;

use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Domain\Repositories\Reply\FindReplyRepositoryInterface;

class FindReplyRepository implements FindReplyRepositoryInterface
{
    public function handle(string $id): Reply|null
    {
        return Reply::query()->where("id", "=", $id)
            ->first();
    }
}
