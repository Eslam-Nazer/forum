<?php

namespace Modules\Forum\Domain\Repositories\User;

use Illuminate\Database\Eloquent\Builder;

interface FindUserRepositoryInterface
{
    public function handle(string $name): Builder;
}
