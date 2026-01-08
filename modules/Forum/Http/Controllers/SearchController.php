<?php

namespace Modules\Forum\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Inertia\Inertia;
use Inertia\Response;
use Modules\Forum\Application\UseCases\Search\ShowUseCase;
use Modules\Forum\Infrastructure\Cache\Trending;

class SearchController extends Controller
{
    /**
     * @param ShowUseCase $case
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|Response
     */
    public function show(ShowUseCase $case, Trending $trending): Response|LengthAwarePaginator
    {
        $threads = $case->execute();

        if (request()->wantsJson()) {
            return $threads;
        }

        return Inertia::render('threads/Index', [
            'Threads' => $threads,
            'trending' => $trending->get(),
        ]);
    }
}
