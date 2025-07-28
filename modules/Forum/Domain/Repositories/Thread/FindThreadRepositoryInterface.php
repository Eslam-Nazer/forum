<?php

namespace Modules\Forum\Domain\Repositories\Thread;

use Modules\Forum\Domain\Models\Thread;

interface FindThreadRepositoryInterface
{
    public function handle(string $thread_id): Thread|null;
}
