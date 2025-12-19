<?php

namespace Modules\Forum\Application\UseCases\Thread;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\Forum\Application\DTOs\Thread\AllThreadsFilteredDto;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Thread\Filters\FilterThreadsRepositoryInterface;
use Modules\Forum\Domain\Repositories\Thread\ThreadsRepositoryInterface;

class ThreadsUseCase
{
    public function __construct(
        protected ThreadsRepositoryInterface              $threadsRepository,
        private readonly FilterThreadsRepositoryInterface $filterThreadsRepository,
    ) {}

    public function execute(AllThreadsFilteredDto $dto): Collection|LengthAwarePaginator
    {
        $threads = $this->threadsRepository->handle($dto->channel);

        $threads = $this->filterThreadsRepository->apply($threads, request());

        $threads->each(function (Thread $thread) {
            return $thread->append('visits_count');
        });


        return $threads->paginate(5);
    }
}
