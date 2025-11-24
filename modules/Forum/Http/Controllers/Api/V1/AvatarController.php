<?php

namespace Modules\Forum\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Forum\Http\Requests\AvatarRequest;

class AvatarController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('auth'),
        ];
    }

    public function store(AvatarRequest $request)
    {
        auth()->user()->update([
            'avatar_path' => $request->file('avatar')?->store('avatars', 'public')
        ]);

        return back();
    }
}
