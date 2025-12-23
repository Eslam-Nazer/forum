<?php

namespace Modules\Forum\Tests\Unit;

use App\Models\User;
use App\Notifications\ThreadWasUpdated;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Notification;
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

    public function test_a_thread_notifies_registered_subscribers_when_a_reply_is_added(): void
    {
        Notification::fake();

        $this->signIn();

        $this->thread->subscribe();

        $this->thread->addReply([
            'body' => 'Foobar',
            'user_id' => create(User::class, ['name' => 'John Doe'])->id,
        ]);

        Notification::assertSentTo(auth()->user(), ThreadWasUpdated::class);
    }

    public function test_a_thread_belongs_to_a_channel(): void
    {
        $thread = create(Thread::class);

        $this->assertInstanceOf(Channel::class, $thread->channel);
    }

    public function test_a_thread_has_a_path(): void
    {
        $thread = create(Thread::class);

        $this->assertEquals(
            "/threads/{$thread->channel->slug}/{$thread->slug}",
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

    public function test_it_if_the_authenticated_user_is_subscribe_to_thread(): void
    {
        $this->signIn();

        $thread = create(Thread::class);

        $thread->subscribe();

        $this->assertTrue($thread->isSubScribedTo);
    }

    public function test_a_thread_can_check_if_the_authenticated_user_has_read_all_replies(): void
    {
        $this->signIn();

        $thread = create(Thread::class);

        tap(auth()->user(), function (User $user) use ($thread) {
            $this->assertTrue($thread->has_updates_for);
            $user->read($thread);
            $this->assertFalse($thread->has_updates_for);
        });
    }

    public function test_a_thread_record_each_visits(): void
    {
        $this->signIn();

        $thread = create(Thread::class);

        $thread->visits()->reset();

        $this->assertSame(0, $thread->visits()->count());

        $thread->visits()->record();

        $this->assertEquals(1, $thread->visits()->count());

        $thread->visits()->record();

        $this->assertEquals(2, $thread->visits()->count());
    }

    public function test_a_thread_may_be_locked(): void
    {
        $thread = create(Thread::class);

        $this->assertFalse($thread->locked);

        $thread->lock();

        $this->assertTrue($thread->locked);
    }
}
