<?php

namespace Modules\Forum\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controllers\HasMiddleware;
use Modules\Forum\Application\DTOs\Favorite\DestroyFavoriteDto;
use Modules\Forum\Application\UseCases\Favorite\CreateFavoriteUseCase;
use Modules\Forum\Application\UseCases\Favorite\DestroyFavoriteUseCase;

class FavoriteController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    /**
     * Store a newly created resource in storage.
     * @param string $id
     * @param CreateFavoriteUseCase $case
     * @return RedirectResponse
     */
    public function store(string $type, string $id, CreateFavoriteUseCase $case): RedirectResponse
    {
        $case->execute($id, $type);
        return redirect()->back();
    }

    /**
     * Summary of destroy
     * @param string $type
     * @param string $id
     * @param DestroyFavoriteUseCase $case
     * @return RedirectResponse
     */
    public function destroy(string $type, string $id, DestroyFavoriteUseCase $case): RedirectResponse
    {
        $dto = new DestroyFavoriteDto($id, $type);

        $case->execute($dto);
        return redirect()->back();
    }
}
