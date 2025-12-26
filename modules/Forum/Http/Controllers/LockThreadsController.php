<?php

namespace Modules\Forum\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Forum\Application\UseCases\LockThread\StoreUseCase;

class LockThreadsController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can-lock-thread')
        ];
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(string $slug, StoreUseCase $case): RedirectResponse
    {
        $case->execute($slug);
        return back()->with('messages', ['success' => 'Thread is locked.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
