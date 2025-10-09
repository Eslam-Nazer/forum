<?php

namespace Modules\Forum\Application\UseCases\Favorite;

use Modules\Forum\Application\DTOs\Favorite\DestroyFavoriteDto;
use Modules\Forum\Domain\Repositories\Favorite\DestroyFavoriteRepositoryInterface;

class DestroyFavoriteUseCase
{
    public function __construct(
        private DestroyFavoriteRepositoryInterface $repository
    ) {}

    public function execute(DestroyFavoriteDto $dto)
    {
        $this->repository->destroy($dto->type, $dto->id);
    }
}
