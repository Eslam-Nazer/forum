<?php

namespace Modules\Forum\Infrastructure\Filters\Thread;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Modules\Forum\Domain\Contracts\Thread\FilterStrategyInterface;

class PopularFilterStrategy implements FilterStrategyInterface
{
    /**
     * @param Builder $query
     * @param Request $request
     * @return Builder
     */
    public function apply(Builder $query, Request $request): Builder
    {
        if ($this->canHandle($request)) {
            $query->getQuery()->orders = [];
            $query->orderBy('replies_count', 'desc');
        }

        return $query;
    }

    /**
     * @param Request $request
     * @return bool
     */
    public function canHandle(Request $request): bool
    {
        return $request->exists('popular') && $request->query('popular', true) === true;
    }

}
