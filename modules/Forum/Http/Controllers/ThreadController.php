<?php

namespace Modules\Forum\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Collection;
use Inertia\Response;
use Modules\Forum\Application\DTOs\Thread\AllThreadsFilteredDto;
use Modules\Forum\Application\DTOs\Thread\CreateThreadDto;
use Modules\Forum\Application\UseCases\Thread\AllThreadsUseCase;
use Modules\Forum\Application\UseCases\Thread\CreateThreadUseCase;
use Modules\Forum\Application\UseCases\Thread\FindThreadUseCase;
use Modules\Forum\Http\Requests\Thread\CreateThreadRequest;

class ThreadController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['index', 'show']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, AllThreadsUseCase $case, ?string $channel = null): View|Collection
    {
        $dto = new AllThreadsFilteredDto(channel: $channel);
        $threads = $case->execute($request, $dto);

        if ($request->wantsJson()) {
            return $threads;
        }

        return view('forum::threads.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('forum::threads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateThreadRequest $request, CreateThreadUseCase $case): RedirectResponse
    {
        $data = new CreateThreadDto(
            userId: auth()->id(),
            channelId: $request->validated('channel_id'),
            title: $request->validated('title'),
            body: $request->validated('body')
        );
        $thread = $case->execute($data);
        return redirect($thread->path());
    }

    /**
     * Show the specified resource.
     */
    public function show(string $channel, string $id, FindThreadUseCase $case): Response|View
    {
        $thread = $case->execute($id, $channel);
        return view('forum::threads.show', compact('thread'));
    }
}
