<?php

namespace Modules\Forum\Application\DTOs\Favorite;

class DestroyFavoriteDto
{
    public function __construct(
        public string $id,
        public string $type
    ) {}
}
