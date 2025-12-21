<?php

namespace Modules\Forum\Domain\Repositories\Favorite;

interface DeleteFavoriteRepositoryInterface
{
    public function destroy(string $type, string $id): void;
}
