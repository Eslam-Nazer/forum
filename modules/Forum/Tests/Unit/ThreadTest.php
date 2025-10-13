<?php

namespace Modules\Forum\Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Modules\Forum\Domain\Models\Channel;
use Modules\Forum\Domain\Models\Thread;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    protected Thread $thread;

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

    public function test_a_thread_belongs_to_a_channel(): void
    {
        $thread = create(Thread::class);

        $this->assertInstanceOf(Channel::class, $thread->channel);
    }

    public function test_a_thread_can_make_a_string_path(): void
    {
        $thread = create(Thread::class);

        $this->assertEquals(
            "/threads/{$thread->channel->slug}/{$thread->id}",
            $thread->path()
        );
    }

    public function test_a_thread_can_be_subscribed_to(): void
    {
        $this->signIn();
        $thread = create(Thread::class);

        $thread->subscribe();

        $this->assertEquals(
            1,
            $thread->subscriptions()->where('user_id', auth()->guard()->id())->count()
        );
    }

    public function test_a_thread_can_be_unsubscribed_from(): void
    {
        $this->signIn();
        $thread = create(Thread::class);

        $thread->subscribe();
        $thread->unsubscribe();

        $this->assertEquals(
            0,
            $thread->subscriptions()->where('user_id', auth()->guard()->id())->count()
        );
    }
}
