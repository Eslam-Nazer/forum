<?php

namespace Modules\Forum\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use JsonException;
use Modules\Forum\Application\DTOs\Thread\AllThreadsFilteredDto;
use Modules\Forum\Application\DTOs\Thread\StoreThreadDto;
use Modules\Forum\Application\DTOs\Thread\DeleteThreadDto;
use Modules\Forum\Application\UseCases\Thread\ThreadsUseCase;
use Modules\Forum\Application\UseCases\Thread\StoreThreadUseCase;
use Modules\Forum\Application\UseCases\Thread\DeleteThreadUseCase;
use Modules\Forum\Application\UseCases\Thread\ShowThreadUseCase;
use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Http\Requests\Thread\CreateThreadRequest;
use Modules\Forum\Infrastructure\Cache\Trending;
use Illuminate\Http\Response as HttpResponse;

class ThreadController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
            new Middleware('must-be-confirmed', ['store']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ThreadsUseCase $case, Trending $trending, ?string $channel = null): View|Collection|Response|LengthAwarePaginator
    {
        $dto = new AllThreadsFilteredDto(channel: $channel);
        $threads = $case->execute($dto);

        if (request()->wantsJson()) {
            return $threads;
        }

        return Inertia::render('threads/Index', [
            'Threads' => $threads,
            'slug' => $channel,
            'trending' => $trending->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View|Response
    {
        return Inertia::render('threads/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateThreadRequest $request, StoreThreadUseCase $case): RedirectResponse|HttpResponse
    {
        $data = new StoreThreadDto(
            userId: Auth::id(),
            channelId: $request->validated('channel_id'),
            title: $request->validated('title'),
            body: $request->validated('body')
        );
        $thread = $case->execute($data);

        if (request()->wantsJson()) {
            return response($thread, 201);
        }

        return redirect()->route('threads.index');
    }

    /**
     * Show the specified resource.
     * @throws JsonException
     */
    public function show(string $channel, string $slug, ShowThreadUseCase $case): Response|View
    {
        $thread = $case->execute($slug, $channel);

        return Inertia::render('threads/Show', [
            'thread' => $thread,
        ]);
    }

    public function destroy(string $channel, string $slug, DeleteThreadUseCase $case): RedirectResponse
    {
        $dto = new DeleteThreadDto($channel, $slug);
        $case->execute($dto);
        return redirect()->route('threads.index');
    }
}
