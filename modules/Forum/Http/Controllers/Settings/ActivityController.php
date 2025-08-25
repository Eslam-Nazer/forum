<?php

namespace Modules\Forum\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ActivityController extends Controller
{
    public function index(Request $request): Response|RedirectResponse
    {
        if (auth()->check()) {
            $user = auth()->user();
            return Inertia::render('settings/activities', [
                'activities' => $user->activities()->get(),
                'user' => $user
            ]);
        }
        return  redirect()->route('login');
    }
}
