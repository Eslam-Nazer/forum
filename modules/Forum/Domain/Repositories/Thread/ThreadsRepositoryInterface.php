<?php

namespace Modules\Forum\Domain\Repositories\Thread;

use Illuminate\Database\Eloquent\Builder;

interface ThreadsRepositoryInterface
{
    public function handle(string|null $channel = null): Builder;
}
