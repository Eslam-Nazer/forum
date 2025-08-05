<?php

namespace Modules\Forum\Domain\Contracts\Thread;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

interface FilterStrategyInterface
{
    /**
     * @param Builder $query
     * @param Request $request
     * @return Builder
     */
    public function apply(Builder $query, Request $request): Builder;
    /**
     * @param Request $request
     * @return bool
     */
    public function canHandle(Request $request): bool;
}
