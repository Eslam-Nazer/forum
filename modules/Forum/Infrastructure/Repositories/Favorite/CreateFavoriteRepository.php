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

        if ($reply->exists() && !$this->favoriteReplyExists($reply, $id)) {
            $reply->favorite();
        }
    }

    /**
     * @param Reply $reply
     * @param string $userId
     * @return bool
     */
    public function favoriteReplyExists(Reply $reply,string $userId): bool
    {
        return $reply->favorites()
            ->where([
                'user_id' => $userId,
                'favorite_id' => $reply->id,
                'favorite_type' => $reply->getMorphClass()
            ])
            ->exists();
    }
}
