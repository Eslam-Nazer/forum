<?php

namespace Modules\Forum\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Modules\Forum\Application\DTOs\Reply\UserAddReplyInThreadDto;
use Modules\Forum\Application\UseCases\Reply\DeleteReplyUseCase;
use Modules\Forum\Application\UseCases\Reply\UpdateReplyUseCase;
use Modules\Forum\Application\UseCases\Reply\StoreReplyUseCase;
use Modules\Forum\Http\Requests\Reply\UpdateReplyRequest;
use Modules\Forum\Http\Requests\Reply\StoreReplyRequest;

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

    public function store(string $channel, string $threadId, StoreReplyRequest $request, StoreReplyUseCase $case): RedirectResponse
    {
        $dto = new UserAddReplyInThreadDto($threadId, $request->user()->id, $request->post('body'));

        $case->execute($dto);
        return back()
            ->with('messages', ['success' => 'Reply added successfully.']);
    }

    public function update(UpdateReplyRequest $request, string $id, UpdateReplyUseCase $case): RedirectResponse
    {
        $case->execute($id);

        return back()->with('messages', ['success' => 'Reply updated successfully.']);
    }

    public function destroy(string $id, DeleteReplyUseCase $case): RedirectResponse
    {
        $case->execute($id);

        return redirect()->back();
    }
}
