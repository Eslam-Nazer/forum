<?php

namespace Modules\Forum\Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Modules\Forum\Domain\Models\Thread;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;
    public function setUp(): void
    {
        parent::setUp();
        $this->thread = Thread::factory()->create();
    }

    public function test_a_thread_has_replies(): void
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    public function test_a_thread_has_creator(): void
    {
        $this->assertInstanceOf(User::class, $this->thread->creator);
    }

    public function test_user_can_add_a_reply(): void
    {
        $this->thread->addReply([
            'body' => 'Foobar',
            'user_id' => 1
        ]);

        $this->assertCount(1, $this->thread->replies);
    }
}
