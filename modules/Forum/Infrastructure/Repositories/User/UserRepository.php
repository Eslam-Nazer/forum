<?php

namespace Modules\Forum\Infrastructure\Repositories\User;

use Illuminate\Database\Eloquent\Builder;
use Modules\Forum\Domain\Models\User;
use Modules\Forum\Domain\Repositories\User\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Return user builder query
     *
     * @return Builder
     */
    public function handle(): Builder
    {
        return User::query();
    }
}
