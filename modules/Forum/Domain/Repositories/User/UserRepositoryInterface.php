<?php

namespace Modules\Forum\Domain\Repositories\User;

use Illuminate\Database\Eloquent\Builder;

interface UserRepositoryInterface
{
    /**
     * User builder query interface
     *
     * @return Builder
     */
    public function handle(): Builder;
}
