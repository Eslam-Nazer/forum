<?php

namespace Modules\Forum\Application\UseCases\RegisterConfirmation;

use Exception;
use Illuminate\Http\RedirectResponse;
use Modules\Forum\Domain\Repositories\User\UserRepositoryInterface;

class ConfirmUseCase
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    )
    {
    }

    /**
     * Execute confirmation functionality for user
     *
     * @return RedirectResponse
     */
    public function execute(): RedirectResponse
    {
        $user = $this->userRepository
            ->handle()
            ->where('confirmation_token', '=', request('token'))
            ->first();

        if (!$user) {
            return redirect()->route('threads.index')
                ->with('messages', ['error' => 'Invalid confirmation token.']);
        }

        $user->update([
            'confirmed' => true,
            'confirmation_token' => null,
        ]);
        return redirect()
            ->route('threads.index')
            ->with('messages', [
                'success' => 'Your account has been confirmed. you may post to the forum.'
            ]);
    }
}
