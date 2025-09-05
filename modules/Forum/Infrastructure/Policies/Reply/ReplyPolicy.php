<?php

namespace Modules\Forum\Infrastructure\Policies\Reply;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Modules\Forum\Domain\Models\Reply;

class ReplyPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Reply $reply): bool
    {
        return $user->id === $reply->user_id;
    }

    public function delete(User $user, Reply $reply): bool
    {
        return $user->id === $reply->user_id;
    }
}
