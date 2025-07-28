<?php

namespace Modules\Forum\Application\UseCases\Thread;

use Illuminate\Support\Collection;
use Modules\Forum\Application\DTOs\Thread\AllThreadsFilteredDto;
use Modules\Forum\Domain\Models\Channel;
use Modules\Forum\Domain\Repositories\Thread\AllThreadsRepositoryInterface;

class AllThreadsUseCase
{
    public function __construct(
        protected AllThreadsRepositoryInterface $allThreadsRepository
    )
    {
    }

    public function execute(AllThreadsFilteredDto $dto): Collection
    {
//        if (filled($dto->channel)) {
            $channel = Channel::query()->where('slug', '=',$dto->channel)->firstOr(fn() => null);

            if(filled($channel)) {
                return $this->allThreadsRepository->handle($channel->id);
            }
            return $this->allThreadsRepository->handle($channel);
//        }

//        return $this->allThreadsRepository->handle();
    }

}
