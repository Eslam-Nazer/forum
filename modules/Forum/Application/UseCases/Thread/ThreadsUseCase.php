<?php

namespace Modules\Forum\Application\UseCases\Thread;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\Forum\Application\DTOs\Thread\ThreadsFilteredDto;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Thread\Filters\FilterThreadsRepositoryInterface;
use Modules\Forum\Domain\Repositories\Thread\ThreadsRepositoryInterface;

class ThreadsUseCase
{
    public function __construct(
        protected ThreadsRepositoryInterface              $threadsRepository,
        private readonly FilterThreadsRepositoryInterface $filterThreadsRepository,
    ) {}

    public function execute(ThreadsFilteredDto $dto): Collection|LengthAwarePaginator
    {
        $threads = $this->threadsRepository->handle($dto->channel);

        $threads = $this->filterThreadsRepository->apply($threads, request());

        return $threads->paginate(5)->through(fn ($thread)=> $thread->append('visits_count'));
    }
}
