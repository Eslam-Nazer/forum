<?php

namespace Modules\Forum\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Modules\Forum\Application\DTOs\Reply\UserAddReplyInThreadDto;
use Modules\Forum\Application\UseCases\Reply\DeleteReplyUseCase;
use Modules\Forum\Application\UseCases\Reply\UpdateReplyUseCase;
use Modules\Forum\Application\UseCases\Reply\UserAddReplyInThreadUseCase;
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

    public function index()
    {
        return view('forum::index');
    }

    public function create()
    {
        return view('forum::create');
    }

    public function store(string $channel, string $threadId, UserAddReplyInThreadRequest $request, UserAddReplyInThreadUseCase $case): RedirectResponse
    {
        $data = new UserAddReplyInThreadDto($threadId, auth()->id(), $request->validated('body'));

        $thread = $case->execute($data);
        return redirect()->route('threads.show', ['channel' => $thread->channel->slug, 'id' => $thread->id]);
    }

    public function show($id)
    {
        return view('forum::show');
    }

    public function edit($id)
    {
        return view('forum::edit');
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
