<?php

namespace Modules\Forum\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Modules\Forum\Domain\Models\Activity;

class ActivityController extends Controller
{
    public function index(): Response|RedirectResponse
    {
        if (auth()->check()) {
            $user = auth()->user();
            return Inertia::render('settings/activities', [
                'activities' => Activity::feed($user),
                'user' => $user
            ]);
        }
        return  redirect()->route('login');
    }
}
