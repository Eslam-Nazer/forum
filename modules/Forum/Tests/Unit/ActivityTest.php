<?php

namespace Modules\Forum\Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Modules\Forum\Domain\Models\Activity;
use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Domain\Models\Thread;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use DatabaseMigrations;

    public function test_records_activity_when_thread_is_created(): void
    {
        $this->signIn();
        $thread = create(Thread::class, ['user_id' => auth()->id()]);

        $this->assertDatabaseHas('activities', [
            'type' => 'created_thread',
            'user_id' => auth()->id(),
            'subject_id' => $thread->id,
            'subject_type' => get_class($thread),
        ]);

        $activity = Activity::query()->first();

        $this->assertEquals($activity->subject->id, $thread->id);
    }

    public function test_records_Activity_when_reply_is_created(): void
    {
        $this->signIn();

        $reply = create(Reply::class);

        $this->assertEquals(2, Activity::query()->count());
    }

    public function test_fetching_a_feed_for_any_user(): void
    {
        $this->signIn();
        create(Thread::class, ['user_id' => auth()->id()], 2);

        auth()->user()->activities()->first()->update(['created_at' => now()->subWeek()]);
        $feed = Activity::feed(auth()->user());

        $this->assertTrue($feed->keys()->contains(
            now()->format('Y-m-d')
        ));

        $this->assertTrue($feed->keys()->contains(
            now()->subWeek()->format('Y-m-d')
        ));
    }
}
