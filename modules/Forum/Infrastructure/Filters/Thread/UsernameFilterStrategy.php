<?php

namespace Modules\Forum\Infrastructure\Filters\Thread;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Modules\Forum\Domain\Contracts\Thread\FilterStrategyInterface;
use Modules\Forum\Domain\Models\Thread;

class UsernameFilterStrategy implements FilterStrategyInterface
{
    /**
     * @param Builder<Thread> $query
     * @param Request $request
     * @return Builder
     */
    public function apply(Builder $query, Request $request): Builder
    {
        if (! $this->canHandle($request)) {
            return $query;
        }

        $name = $request->query('by');
        $query->whereHas('creator', function (Builder $query) use ($name) {
            $query->where('name', $name);
        });

        return $query;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function canHandle(Request $request): bool
    {
        return $request->filled('by');
    }
}
