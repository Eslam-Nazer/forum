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
use Modules\Forum\Application\DTOs\Thread\AllThreadsFilteredDto;
use Modules\Forum\Application\DTOs\Thread\CreateThreadDto;
use Modules\Forum\Application\DTOs\Thread\DeleteThreadDto;
use Modules\Forum\Application\UseCases\Thread\AllThreadsUseCase;
use Modules\Forum\Application\UseCases\Thread\StoreThreadUseCase;
use Modules\Forum\Application\UseCases\Thread\DeleteThreadUseCase;
use Modules\Forum\Application\UseCases\Thread\ShowThreadUseCase;
use Modules\Forum\Http\Requests\Thread\CreateThreadRequest;

class ThreadController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, AllThreadsUseCase $case, ?string $channel = null): View|Collection|Response|LengthAwarePaginator
    {
        $dto = new AllThreadsFilteredDto(channel: $channel);
        $threads = $case->execute($request, $dto);

        $threads->through(function ($thread) {
            $thread->can = [
                'update' => request()->user()->can('update', $thread),
                'delete' => request()->user()->can('delete', $thread),
            ];

            return $thread;
        });

        if ($request->wantsJson()) {
            return $threads;
        }

        return Inertia::render('threads/Index', [
            'Threads' => $threads,
            'slug' => $channel
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
    public function store(CreateThreadRequest $request, StoreThreadUseCase $case): RedirectResponse
    {
        $data = new CreateThreadDto(
            userId: Auth::id(),
            channelId: $request->validated('channel_id'),
            title: $request->validated('title'),
            body: $request->validated('body')
        );
        $thread = $case->execute($data);
        return redirect()->route('threads.index');
    }

    /**
     * Show the specified resource.
     */
    public function show(string $channel, string $id, ShowThreadUseCase $case): Response|View
    {
        $thread = $case->execute($id, $channel);

        return Inertia::render('threads/Show', [
            'thread' => [
                'id' => $thread->id,
                'title' => $thread->title,
                'body' => $thread->body,
                'channel' => $thread->channel,
                'replies' => $thread->replies->map(fn($reply) => [
                    'id' => $reply->id,
                    'body' => $reply->body,
                    'owner' => $reply->owner,
                    'created_at' => $reply->created_at,
                    'updated_at' => $reply->updated_at,
                    'is_favorite' => $reply->is_favorite,
                    'favorites_count' => $reply->favorites_count,
                    'can' => [
                        'update' => request()->user()->can('update', $reply),
                        'delete' => request()->user()->can('delete', $reply),
                    ]
                ]),
                'creator' => $thread->creator,
                'isFavorite' => $thread->is_favorite,
                'isSubscribedTo' => $thread->is_subscribed_to,
                'created_at' => $thread->created_at,
                'can' => [
                    'update' => request()->user()->can('update', $thread),
                    'delete' => request()->user()->can('delete', $thread),
                ]
            ],
        ]);
    }

    public function destroy(string $channel, string $id, DeleteThreadUseCase $case): RedirectResponse
    {
        $dto = new DeleteThreadDto($channel, $id);
        $case->execute($dto);
        return redirect()->route('threads.index');
    }
}
