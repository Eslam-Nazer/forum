<?php

namespace Modules\Forum\Domain\Repositories\Reply;

use Modules\Forum\Domain\Models\Reply;

interface FindReplyRepositoryInterface
{
    public function handle(string $id): Reply|null;
}
