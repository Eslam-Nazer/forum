<?php

namespace Modules\Forum\Application\UseCases\Favorite;

use Modules\Forum\Domain\Repositories\Favorite\StoreFavoriteRepositoryInterface;

readonly class CreateFavoriteUseCase
{
    /**
     * @param StoreFavoriteRepositoryInterface $repository
     */
    public function __construct(
        protected StoreFavoriteRepositoryInterface $repository
    )
    {
    }

    /**
     * @param string $id
     * @return void
     */
    public function execute(string $id, string $type): void
    {
        $this->repository->handle(auth()->id(), $type,$id);
    }
}
