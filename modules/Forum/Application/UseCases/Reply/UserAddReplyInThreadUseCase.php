<?php

namespace Modules\Forum\Application\UseCases\Reply;

use Modules\Forum\Application\DTOs\Reply\UserAddReplyInThreadDto;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Reply\UserAddReplyInThreadRepositoryInterface;

class UserAddReplyInThreadUseCase
{
    public function __construct(
        protected UserAddReplyInThreadRepositoryInterface $userAddReplyInThread
    ){}
    public function execute(UserAddReplyInThreadDto $dto): Thread
    {
        return $this->userAddReplyInThread->handle($dto->threadId,$dto->userId,$dto->body);
    }
}
