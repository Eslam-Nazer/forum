<?php

namespace Modules\Forum\Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
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
}
