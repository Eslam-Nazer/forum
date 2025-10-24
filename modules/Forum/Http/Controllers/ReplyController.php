<?php

namespace Modules\Forum\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use Modules\Forum\Application\DTOs\Reply\UserAddReplyInThreadDto;
use Modules\Forum\Application\UseCases\Reply\DeleteReplyUseCase;
use Modules\Forum\Application\UseCases\Reply\UpdateReplyUseCase;
use Modules\Forum\Application\UseCases\Reply\StoreReplyUseCase;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Http\Requests\Reply\UpdateReplyRequest;
use Modules\Forum\Http\Requests\Reply\UserAddReplyInThreadRequest;

class ReplyController extends Controller implements HasMiddleware
{
    /**
     * @return string[]
     */
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    public function store(string $channel, string $threadId, UserAddReplyInThreadRequest $request, StoreReplyUseCase $case): RedirectResponse
    {
        $data = new UserAddReplyInThreadDto($threadId, Auth::id(), $request->validated('body'));

        $thread = $case->execute($data);
        return redirect()->route('threads.show', ['channel' => $thread->channel->slug, 'id' => $thread->id])
            ->with('messages', ['success' => 'Reply added successfully.'])  ;
    }

    public function update(UpdateReplyRequest $request, string $id, UpdateReplyUseCase $case): RedirectResponse
    {
        $case->execute($id);

        return redirect()->back();
    }

    public function destroy(string $id, DeleteReplyUseCase $case): RedirectResponse
    {
        $case->execute($id);

        return redirect()->back();
    }
}
