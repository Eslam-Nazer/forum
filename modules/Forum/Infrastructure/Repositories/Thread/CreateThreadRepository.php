<?php

namespace Modules\Forum\Infrastructure\Repositories\Thread;

use Illuminate\Database\Eloquent\Builder;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Thread\CreateThreadRepositoryInterface;

class CreateThreadRepository implements CreateThreadRepositoryInterface
{
    public function handle(): Builder
    {
        return Thread::query();
    }
}
