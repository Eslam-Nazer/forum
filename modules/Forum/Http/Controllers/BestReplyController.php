<?php

namespace Modules\Forum\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Forum\Application\UseCases\BestReply\StoreUseCase;

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
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    }
}
