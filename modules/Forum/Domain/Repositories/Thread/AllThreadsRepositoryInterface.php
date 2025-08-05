<?php

namespace Modules\Forum\Domain\Repositories\Thread;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

interface AllThreadsRepositoryInterface
{
    public function handle(Request $request, string|null $channel = null): Collection;
}
