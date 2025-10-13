<?php

namespace Modules\Forum\Infrastructure\Filters\Thread;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Modules\Forum\Domain\Contracts\Thread\FilterStrategyInterface;

class UnansweredFilterStrategy implements FilterStrategyInterface
{
    /**
     * Summary of apply
     * @param Builder $query
     * @param Request $request
     * @return Builder
     */
    public function apply(Builder $query, Request $request): Builder
    {
        if ($this->canHandle($request)) {
            $query->where('replies_count', '=', 0);
        }

        return $query;
    }

    /**
     * Summary of canHandle
     * @param Request $request
     * @return bool
     */
    public function canHandle(Request $request): bool
    {
        return $request->exists('unanswered') && $request->boolean('unanswered', true) === true;
    }
}
