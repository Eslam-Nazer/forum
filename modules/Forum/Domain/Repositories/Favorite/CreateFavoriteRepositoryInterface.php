<?php

namespace Modules\Forum\Domain\Repositories\Favorite;

use Modules\Forum\Domain\Models\Reply;

interface CreateFavoriteRepositoryInterface
{
    public function handle(string $userId, string $id): void;

    public function favoriteReplyExists(Reply $reply, string $userId): bool;
}
