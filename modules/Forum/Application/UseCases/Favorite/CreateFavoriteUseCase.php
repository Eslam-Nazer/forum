<?php

namespace Modules\Forum\Application\UseCases\Favorite;

use Modules\Forum\Domain\Repositories\Favorite\CreateFavoriteRepositoryInterface;

readonly class CreateFavoriteUseCase
{
    /**
     * @param CreateFavoriteRepositoryInterface $repository
     */
    public function __construct(
        protected CreateFavoriteRepositoryInterface $repository
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
