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
     * @param string $name
     * @return Model
     */
    public function execute(string $name): Model
    {
        return $this->repository
            ->handle($name)
            ->with(['threads', 'replies'])
            ->firstOrFail();
    }
}
