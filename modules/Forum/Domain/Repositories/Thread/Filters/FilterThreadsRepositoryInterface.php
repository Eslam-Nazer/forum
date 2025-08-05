<?php

namespace Modules\Forum\Domain\Repositories\Thread\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Modules\Forum\Domain\Contracts\Thread\FilterStrategyInterface;

interface FilterThreadsRepositoryInterface
{
    /**
     * @param Builder $query
     * @param Request $request
     * @return Builder
     */
    public function apply(Builder $query, Request $request): Builder;

    /**
     * @param FilterStrategyInterface $filterStrategy
     * @return void
     */
    public function setStrategy(FilterStrategyInterface $filterStrategy): void;

    /**
     * @return array
     */
    public function getStrategy(): array;
}
