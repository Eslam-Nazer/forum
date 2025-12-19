<?php

namespace Modules\Forum\Domain\Repositories\Thread;

use Modules\Forum\Application\DTOs\Thread\StoreThreadDto;
use Modules\Forum\Domain\Models\Thread;

interface StoreThreadRepositoryInterface
{
    public function handle(StoreThreadDto $dto): Thread;
}
