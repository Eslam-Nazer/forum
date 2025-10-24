<?php

namespace Modules\Forum\Application\UseCases\Reply;

use Exception;
use Modules\Forum\Application\DTOs\Reply\UserAddReplyInThreadDto;
use Modules\Forum\Domain\Models\Thread;
use Modules\Forum\Domain\Repositories\Reply\UserAddReplyInThreadRepositoryInterface;
use Modules\Forum\Domain\Services\Spam\Spam;

class StoreReplyUseCase
{
    public function __construct(
        protected UserAddReplyInThreadRepositoryInterface $userAddReplyInThread,
        protected Spam $spam,
    ){}

    /**
     * @param UserAddReplyInThreadDto $dto
     * @return Thread
     * @throws Exception
     */
    public function execute(UserAddReplyInThreadDto $dto): Thread
    {
        $this->spam->detect($dto->body);
        return $this->userAddReplyInThread->handle($dto->threadId,$dto->userId,$dto->body);
    }
}
