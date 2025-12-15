<?php

namespace Modules\Forum\Domain\Repositories\Thread;

use Illuminate\Database\Eloquent\Builder;
use Modules\Forum\Domain\Models\Thread;

interface CreateThreadRepositoryInterface
{
    public function handle(): Builder;
}
