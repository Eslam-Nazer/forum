<?php

namespace Modules\Forum\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
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
    public function index(AllThreadsUseCase $case, ?string $channel = null): View
    {
        $dto = new AllThreadsFilteredDto(channel: $channel);
        $threads = $case->execute($dto);
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
        $thread = $case->execute($id);
        return view('forum::threads.show', compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     */
//    public function edit($id)
//    {
//        return view('forum::edit');
//    }

    /**
     * Update the specified resource in storage.
     */
//    public function update(Request $request, $id)
//    {
//    }

    /**
     * Remove the specified resource from storage.
     */
//    public function destroy($id)
//    {
//    }
}
