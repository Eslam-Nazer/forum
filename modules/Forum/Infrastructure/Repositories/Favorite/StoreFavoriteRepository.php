<?php

namespace Modules\Forum\Infrastructure\Repositories\Favorite;

use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Favorite\StoreFavoriteRepositoryInterface;

class StoreFavoriteRepository implements StoreFavoriteRepositoryInterface
{
    /**
     * @param string $userId
     * @param string $type
     * @param string $id
     * @return void
     */
    public function handle(string $userId, string $type, string $id): void
    {
        $model = '';
        if ($type === 'replies') {
            $model = Reply::query()->find($id);
        } elseif ($type === 'threads') {
            $model = Thread::query()->find($id);
        }


        if ($model) {
            $model->favorite($userId);
        } else {
            abort(404);
        }
    }
}
