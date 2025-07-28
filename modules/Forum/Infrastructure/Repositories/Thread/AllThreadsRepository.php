<?php

namespace Modules\Forum\Infrastructure\Repositories\Thread;

use Illuminate\Support\Collection;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Thread\AllThreadsRepositoryInterface;

class AllThreadsRepository implements AllThreadsRepositoryInterface
{
    public function handle(): Collection
    {
        return Thread::all();
    }
}
