<?php

namespace Modules\Forum\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Forum\Application\DTOs\Thread\FindThreadDto;
use Modules\Forum\Application\UseCases\ThreadSubscription\SubscribeThreadUseCase;
use Modules\Forum\Application\UseCases\ThreadSubscription\UnsubscribeThreadUseCase;

class ThreadSubScriptionController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
        ];
    }

    public function store(string $channelSlug, string $threadId, SubscribeThreadUseCase $case, Request $request): RedirectResponse
    {
        $dto = new FindThreadDto($channelSlug, $threadId);
        $case->execute($dto);

        return redirect()
            ->back()
            ->with('messages', ['success' => 'Subscribed to thread successfully.']);
    }

    public function destroy(string $channelSlug, string $threadId, UnsubscribeThreadUseCase $case): RedirectResponse
    {
        $dto = new FindThreadDto($channelSlug, $threadId);
        $case->execute($dto);

        return redirect()
            ->back()
            ->with('messages', ['info' => 'Unsubscribed from thread successfully.']);
    }
}
