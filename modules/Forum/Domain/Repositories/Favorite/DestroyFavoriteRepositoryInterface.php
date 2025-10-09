<?php

namespace Modules\Forum\Domain\Repositories\Favorite;

interface DestroyFavoriteRepositoryInterface
{
    public function destroy(string $type, string $id): void;
}
