<?php

namespace Modules\Forum\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ThreadController extends Controller
{
    public function index(Request $request): Response
    {
        return Inertia::render('settings/threads', [
            'threads' => $request->user()->threads()->get(),
        ]);
    }
}
