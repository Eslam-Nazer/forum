<?php

namespace Modules\Forum\Domain\Repositories\Thread;

use Illuminate\Support\Collection;
use Modules\Forum\Domain\Models\Thread;

interface AllThreadsRepositoryInterface
{
    public function handle(string|null $channel = null): Collection;
}
