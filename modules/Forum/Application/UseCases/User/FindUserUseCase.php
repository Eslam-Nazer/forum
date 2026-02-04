<?php

namespace Modules\Forum\Application\UseCases\User;

use Illuminate\Database\Eloquent\Model;
use Modules\Forum\Domain\Repositories\User\FindUserRepositoryInterface;

class FindUserUseCase
{
    /**
     * @param FindUserRepositoryInterface $repository
     */
    public function __construct(
        protected FindUserRepositoryInterface $repository,
    ) {}

    /**
     * @param string $slug
     * @return Model
     */
    public function execute(string $slug): Model
    {
        return $this->repository
            ->handle($slug)
            ->with(['threads', 'replies'])
            ->firstOrFail();
    }
}
