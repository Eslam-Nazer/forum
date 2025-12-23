<?php

namespace Modules\Forum\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Modules\Forum\Domain\Models\Thread;
use Tests\TestCase;

class LockThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function test_an_admin_can_lock_threads(): void
    {
        $this->signIn();
        $thread = create(Thread::class);

        $thread->lock();

        $this->post(
            route('replies.store', ['threadSlug' => $thread->slug]),
            [
                'body' => 'test body',
                'user_id' => auth()->id(),
            ]
        )
        ->assertStatus(422);
    }
}
