<?php

namespace Modules\Forum\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Modules\Forum\Application\UseCases\RegisterConfirmation\ConfirmUseCase;

class RegisterConfirmationController extends Controller
{
    /**
     * User confirmation method
     *
     * @param ConfirmUseCase $case
     * @return RedirectResponse
     */
    public function index(ConfirmUseCase $case): RedirectResponse
    {
        $case->execute();
        return redirect()
            ->route('threads.index')
            ->with('messages', [
                'success' => 'Your account has been confirmed. you may post to the forum.'
            ]);
    }
}
