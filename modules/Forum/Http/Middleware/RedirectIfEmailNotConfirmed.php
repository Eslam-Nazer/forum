<?php

namespace Modules\Forum\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RedirectIfEmailNotConfirmed
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user()->confirmed) {
            return redirect()
                ->route('threads.index')
                ->with('messages', ['warning' => 'You need to confirm your email before creating a thread.']);
        }

        return $next($request);
    }
}
