<?php

namespace Modules\Forum\Application\UseCases\Thread;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\Forum\Application\DTOs\Thread\AllThreadsFilteredDto;
use Modules\Forum\Domain\Models\Channel;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Thread\AllThreadsRepositoryInterface;

class AllThreadsUseCase
{
    public function __construct(
        protected AllThreadsRepositoryInterface $allThreadsRepository,
    ) {}

    public function execute(Request $request, AllThreadsFilteredDto $dto): Collection|LengthAwarePaginator
    {
        $threads = $this->allThreadsRepository->handle($request, $dto->channel);

        $threads->through(function (Thread $thread) {
            $thread->can = [
                'update' => request()->user()->can('update', $thread),
                'delete' => request()->user()->can('delete', $thread),
            ];

            return $thread->append('visits');
        });

        return $threads;
    }
}
