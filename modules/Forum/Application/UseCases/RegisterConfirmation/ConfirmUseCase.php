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
     * @return bool|RedirectResponse
     */
    public function execute(): bool|RedirectResponse
    {
        try {
            return $this->userRepository
                ->handle()
                ->where('confirmation_token', '=', request('token'))
                ->firstOrFail()
                ->update(['confirmed' => true]);
        } catch (Exception $exception) {
            return redirect()->route('threads.index')
                ->with('messages', ['error' => 'Invalid confirmation token.']);
        }
    }
}
