<?php

namespace Modules\Forum\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Forum\Application\UseCases\BestReply\DeleteUseCase;
use Modules\Forum\Application\UseCases\BestReply\StoreUseCase;
use Modules\Forum\Application\UseCases\BestReply\UpdateUseCase;

class BestReplyController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $id, StoreUseCase $case): RedirectResponse
    {
        $reply = $case->execute($id);

        return redirect()->route('threads.show', [
            'channel' => $reply->thread->channel->slug, 'slug' => $reply->thread->slug
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $id, UpdateUseCase $case): RedirectResponse
    {
        $case->execute($id);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, DeleteUseCase $case): RedirectResponse
    {
        $case->execute($id);

        return redirect()->back();
    }
}
