<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json(Auth::user()->unreadNotifications);
    }

    public function destroy(string $notificationId): void
    {
        Auth::user()->notifications()
            ->find($notificationId)
            ->markAsRead();
    }
}
