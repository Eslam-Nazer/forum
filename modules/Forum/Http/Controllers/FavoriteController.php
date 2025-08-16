<?php

namespace Modules\Forum\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Modules\Forum\Application\UseCases\Favorite\CreateFavoriteUseCase;

class FavoriteController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('forum::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('forum::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param string $id
     * @param CreateFavoriteUseCase $case
     * @return RedirectResponse
     */
    public function store(string $id, CreateFavoriteUseCase $case): RedirectResponse
    {
        $case->execute($id);
        return redirect()->back();
    }
}
