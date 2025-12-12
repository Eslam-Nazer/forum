<?php

namespace Modules\Forum\Application\UseCases\RegisterConfirmation;

use Modules\Forum\Domain\Repositories\User\UserRepositoryInterface;

class ConfirmUseCase
{
    public function __construct(
      protected UserRepositoryInterface $userRepository
    ) {}

    /**
     * Execute confirmation functionality for user
     *
     * @return bool
     */
    public function execute(): bool
    {
        return $this->userRepository
            ->handle()
            ->where('confirmation_token', '=', request('token'))
            ->firstOrFail()
            ->update(['confirmed' => true]);
    }
}
