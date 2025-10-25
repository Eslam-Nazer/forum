<?php

namespace Modules\Forum\Infrastructure\Policies\Reply;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Forum\Domain\Models\Reply;

class ReplyPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user) : bool
    {
        return ! $user->fresh()->lastReply?->wasJustPublished();
    }

    /**
     * @param User $user
     * @param Reply $reply
     * @return bool
     */
    public function update(User $user, Reply $reply): bool
    {
        return $user->id === $reply->user_id;
    }

    /**
     * @param User $user
     * @param Reply $reply
     * @return bool
     */
    public function delete(User $user, Reply $reply): bool
    {
        return $user->id === $reply->user_id;
    }
}
