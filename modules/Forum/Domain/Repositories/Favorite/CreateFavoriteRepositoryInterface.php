<?php

namespace Modules\Forum\Domain\Repositories\Favorite;

use Modules\Forum\Domain\Models\Reply;

interface CreateFavoriteRepositoryInterface
{
    /**
     * @param string $userId
     * @param string $id
     * @return void
     */
    public function handle(string $userId, string $id): void;
}
