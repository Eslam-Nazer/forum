<?php

namespace Modules\Forum\Infrastructure\Repositories\Favorite;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Modules\Forum\Domain\Models\Favorite;
use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Favorite\DestroyFavoriteRepositoryInterface;

class DestroyFavoriteRepository implements DestroyFavoriteRepositoryInterface
{
    public function destroy(string $type, string $id): void
    {
        $model = match ($type) {
            'replies' => Reply::query()->find($id),
            'threads' => Thread::query()->find($id),
        };

        $favorite = Favorite::query()
            ->where('user_id', '=', Auth::id())
            ->whereMorphedTo('favorite', $model)
            ->first();

        if ($favorite) {
            $favorite->delete();
        }
    }
}
