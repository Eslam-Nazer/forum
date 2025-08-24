<?php

namespace Modules\Forum\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ThreadController extends Controller
{
    public function index(Request $request): Response|RedirectResponse
    {
        if (Auth::check()) {
            return Inertia::render('settings/threads', [
                'threads' => $request->user()->threads()->get(),
            ]);
        }
        return redirect()->route('login');
    }
}
