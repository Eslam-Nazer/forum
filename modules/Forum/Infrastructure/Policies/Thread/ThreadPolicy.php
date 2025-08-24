<?php

namespace Modules\Forum\Infrastructure\Policies\Thread;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Auth\User;
use Modules\Forum\Domain\Models\Thread;

class ThreadPolicy
{
    use HandlesAuthorization;

    public function __construct() {}

    public function delete(User $user ,Thread $thread): bool
    {
        return $thread->user_id === $user->id;
    }
}
