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

    public function store(string $channelSlug, string $slug, SubscribeThreadUseCase $case, Request $request): RedirectResponse
    {
        $dto = new FindThreadDto($channelSlug, $slug);
        $case->execute($dto);

        return redirect()
            ->back()
            ->with('messages', ['success' => 'Subscribed to thread successfully.']);
    }

    public function destroy(string $channelSlug, string $slug, UnsubscribeThreadUseCase $case): RedirectResponse
    {
        $dto = new FindThreadDto($channelSlug, $slug);
        $case->execute($dto);

        return redirect()
            ->back()
            ->with('messages', ['info' => 'Unsubscribed from thread successfully.']);
    }
}
