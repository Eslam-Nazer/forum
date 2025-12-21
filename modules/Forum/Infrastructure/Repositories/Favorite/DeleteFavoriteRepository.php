<?php

namespace Modules\Forum\Infrastructure\Repositories\Favorite;

use Illuminate\Support\Facades\Auth;
use Modules\Forum\Domain\Models\Favorite;
use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Favorite\DeleteFavoriteRepositoryInterface;

class DeleteFavoriteRepository implements DeleteFavoriteRepositoryInterface
{
    public function destroy(string $type, string $id): void
    {
        $model = match ($type) {
            'replies' => Reply::query()->find($id),
            'threads' => Thread::query()->find($id),
        };

        $model = $model->favorites()
            ->where('user_id', '=', Auth::id())
            ->first();

        if (!$model) {
            abort(404);
        }

        $model->delete();
    }
}
