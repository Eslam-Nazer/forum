<?php

namespace Modules\Forum\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Modules\Forum\Application\DTOs\Reply\UserAddReplyInThreadDto;
use Modules\Forum\Application\UseCases\Reply\UserAddReplyInThreadUseCase;
use Modules\Forum\Domain\Models\Thread;
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

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('forum::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('forum::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserAddReplyInThreadRequest $request, Thread $thread, UserAddReplyInThreadUseCase $case): RedirectResponse
    {
        $data = new UserAddReplyInThreadDto($thread, auth()->id(), $request->validated('body'));

        $case->execute($data);
        return redirect()->route('threads.index', $thread);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('forum::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('forum::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
