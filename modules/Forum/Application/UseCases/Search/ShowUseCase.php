<?php

namespace Modules\Forum\Application\UseCases\Search;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Forum\Domain\Models\Thread;

class ShowUseCase
{
    /**
     * @return LengthAwarePaginator
     */
    public function execute(): LengthAwarePaginator
    {
        return Thread::search(request('q'))
            ->query(fn ($query) => $query->with(['creator', 'favorites']))
            ->paginate(5)
            ->through(fn (Thread $thread) => $thread->append('visits_count'));
    }
}
