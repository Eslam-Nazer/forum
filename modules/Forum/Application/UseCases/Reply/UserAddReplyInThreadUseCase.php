<?php

namespace Modules\Forum\Application\UseCases\Reply;

use Modules\Forum\Application\DTOs\Reply\UserAddReplyInThreadDto;
use Modules\Forum\Domain\Repositories\Reply\UserAddReplyInThreadInterface;

class UserAddReplyInThreadUseCase
{
    public function __construct(
        protected UserAddReplyInThreadInterface $userAddReplyInThread
    ){}
    public function execute(UserAddReplyInThreadDto $dto): void
    {
        $this->userAddReplyInThread->handle($dto->thread,$dto->userId,$dto->body);
    }
}
