<?php

namespace Modules\Forum\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Forum\Domain\Models\User;

class MentionsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(
            User::query()->select('slug', 'name', 'avatar_path')->whereNot('id', auth()->id())->get()
        );
    }
}
