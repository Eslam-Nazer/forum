<?php

namespace Modules\Forum\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Forum\Domain\Repositories\Thread\FindThreadRepositoryInterface;

class CanLockThread
{
    public function __construct(
        protected FindThreadRepositoryInterface $findThreadRepository,
    ) {}

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $thread = $this->findThreadRepository->handle($request->route('slug'));

        abort_if(
            (auth()->check() && auth()->id() !== $thread?->user_id) && !auth()->user()->is_admin,
            403
        );

        return $next($request);
    }
}
