<?php

namespace Modules\Forum\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Modules\Forum\Domain\Models\Thread;
use Tests\TestCase;

class LockThreadsTest extends TestCase
{
    use DatabaseMigrations;

    public function test_once_locked_a_thread_may_not_received_new_replies(): void
    {
        $this->signIn();
        $thread = create(Thread::class, ['user_id' => auth()->id()]);

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

    public function test_non_owner_or_non_admin_may_not_lock_threads(): void
    {
        $this->signIn();
        $thread = create(Thread::class);

        $this->post(
            route('lock-threads.store', ['slug' => $thread->slug])
        )->assertStatus(403);

        $this->assertFalse($thread->fresh()->locked);
    }

    public function test_admin_and_owner_may_lock_a_thread(): void
    {
        $this->signIn(User::factory()->admin()->create());
        $thread = create(Thread::class);

        $this->post(
            route('lock-threads.store', ['slug' => $thread->slug])
        )->assertStatus(302);

        $this->signIn();

        $thread = create(Thread::class, ['user_id' => auth()->id()]);

        $this->post(
            route('lock-threads.store', ['slug' => $thread->slug])
        )->assertStatus(302);
    }
}
