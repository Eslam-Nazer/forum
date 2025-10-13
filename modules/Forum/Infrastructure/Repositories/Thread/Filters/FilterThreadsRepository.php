<?php

namespace Modules\Forum\Infrastructure\Repositories\Thread\Filters;

use Illuminate\Http\Request;
use Modules\Forum\Domain\Models\Thread;
use Illuminate\Database\Eloquent\Builder;
use Modules\Forum\Domain\Contracts\Thread\FilterStrategyInterface;
use Modules\Forum\Infrastructure\Filters\Thread\PopularFilterStrategy;
use Modules\Forum\Infrastructure\Filters\Thread\UsernameFilterStrategy;
use Modules\Forum\Infrastructure\Filters\Thread\UnansweredFilterStrategy;
use Modules\Forum\Domain\Repositories\Thread\Filters\FilterThreadsRepositoryInterface;

class FilterThreadsRepository implements FilterThreadsRepositoryInterface
{
    /**
     * @var array<FilterStrategyInterface>
     */
    private ?array $filters;

    public function __construct()
    {
        $this->initializeFilters();
    }

    /**
     * @param Builder<Thread> $query
     * @param Request $request
     * @return Builder
     */
    public function apply(Builder $query, Request $request): Builder
    {
        foreach ($this->filters as $filter) {
            if ($filter->canHandle($request)) {
                $filter->apply($query, $request);
            }
        }
        return $query;
    }

    private function initializeFilters(): void
    {
        $this->setStrategy(new UsernameFilterStrategy());
        $this->setStrategy(new PopularFilterStrategy());
        $this->setStrategy(new UnansweredFilterStrategy());
    }

    /**
     * @param FilterStrategyInterface $filterStrategy
     * @return void
     */
    public function setStrategy(FilterStrategyInterface $filterStrategy): void
    {
        $this->filters[] = $filterStrategy;
    }

    /**
     * @return array
     */
    public function getStrategy(): array
    {
        return $this->filters;
    }
}
