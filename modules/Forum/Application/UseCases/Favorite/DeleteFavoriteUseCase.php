<?php

namespace Modules\Forum\Application\UseCases\Favorite;

use Modules\Forum\Application\DTOs\Favorite\DestroyFavoriteDto;
use Modules\Forum\Domain\Repositories\Favorite\DeleteFavoriteRepositoryInterface;

class DeleteFavoriteUseCase
{
    public function __construct(
        private DeleteFavoriteRepositoryInterface $repository
    ) {}

    public function execute(DestroyFavoriteDto $dto)
    {
        $this->repository->destroy($dto->type, $dto->id);
    }
}
