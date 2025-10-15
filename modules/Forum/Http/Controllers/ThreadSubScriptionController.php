<?php

namespace Modules\Forum\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Forum\Application\DTOs\Thread\FindThreadDto;
use Modules\Forum\Application\UseCases\ThreadSubscription\SubscribeThreadUseCase;

class ThreadSubScriptionController extends Controller
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
        ];
    }

    public function store(string $channelId, string $threadId, SubscribeThreadUseCase $case, Request $request)
    {
        $dto = new FindThreadDto($channelId, $threadId);
        $case->execute($dto);

        return redirect()->back();
    }

    public function destroy($id) {}
}
