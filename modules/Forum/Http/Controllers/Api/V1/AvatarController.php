<?php

namespace Modules\Forum\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Inertia\Inertia;
use Inertia\Response;
use Modules\Forum\Http\Requests\AvatarRequest;

class AvatarController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
        ];
    }

    /**
     * return index vue for avatar upload
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('settings/Avatar');
    }

    /**
     * Store new avatar
     *
     * @param AvatarRequest $request
     * @return RedirectResponse
     */
    public function store(AvatarRequest $request): RedirectResponse
    {
        auth()->user()->update([
            'avatar_path' => $request->file('avatar')?->store('avatars', 'public')
        ]);

        return back();
    }
}
