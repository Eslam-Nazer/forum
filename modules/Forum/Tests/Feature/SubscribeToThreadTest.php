<?php

namespace Modules\Forum\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Modules\Forum\Domain\Models\Thread;
use Tests\TestCase;

class SubscribeToThreadTest extends TestCase
{
    use DatabaseMigrations;

    public function test_a_user_can_subscribe_to_threads(): void
    {
        $this->signIn();
        $thread = create(Thread::class);
        $this->assertAuthenticated();
        $this->post($thread->path() . '/subscriptions');
        $this->assertCount(1, $thread->subscriptions);
    }

    public function test_a_user_can_unsubscribe_from_threads(): void
    {
        $this->signIn();
        $thread = create(Thread::class);
        $this->assertAuthenticated();
        $this->post($thread->path() . '/subscriptions');
        $this->assertEquals(
            1,
            $thread->subscriptions()
                ->where('user_id', '=', auth()->guard()->id())
                ->count()
        );
        $this->delete($thread->path() . '/subscriptions');
        $this->assertEquals(
            0,
            $thread->subscriptions()
                ->where('user_id', '=', auth()->guard()->id())
                ->count()
        );
    }
}
