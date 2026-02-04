<?php

namespace Modules\Forum\Infrastructure\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Modules\Forum\Domain\Repositories\User\FindUserRepositoryInterface;

class FindUserRepository implements FindUserRepositoryInterface
{
    public function handle(string $slug): Builder
    {
        return User::query()
            ->whereSlug($slug);
    }
}
