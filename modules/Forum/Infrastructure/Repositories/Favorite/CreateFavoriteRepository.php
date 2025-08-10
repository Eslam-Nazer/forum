<?php

namespace Modules\Forum\Infrastructure\Repositories\Favorite;

use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Domain\Repositories\Favorite\CreateFavoriteRepositoryInterface;

class CreateFavoriteRepository implements CreateFavoriteRepositoryInterface
{
    /**
     * @param string $userId
     * @param string $id
     * @return void
     */
    public function handle(string $userId, string $id): void
    {
        $reply = Reply::find($id);

        if ($reply->exists()) {
            $reply->favorite($userId);
        }
    }
}
