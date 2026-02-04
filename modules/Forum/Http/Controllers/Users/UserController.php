<?php

namespace Modules\Forum\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Inertia\Inertia;
use Inertia\Response;
use Modules\Forum\Application\UseCases\User\FindUserUseCase;

class UserController extends Controller implements HasMiddleware
{
    /**
     * @return Middleware[]
     */
    public static function middleware(): array
    {
        return [
            new Middleware('auth')
        ];
    }

    /**
     * @param string $name
     * @param FindUserUseCase $case
     * @return Response
     */
    public function show(string $slug, FindUserUseCase $case): Response
    {
        $user = $case->execute($slug);

        return Inertia::render('Users/Show', [
            'user' => $user,
        ]);
    }
}
