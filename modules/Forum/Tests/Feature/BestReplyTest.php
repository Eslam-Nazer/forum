<?php

namespace Modules\Forum\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Domain\Models\Thread;
use Tests\TestCase;

class BestReplyTest extends TestCase
{
    use DatabaseMigrations;

    public function test_a_thread_creator_may_mark_any_reply_as_the_best_reply(): void
    {
        $this->signIn()->withoutExceptionHandling();

        $thread = create(Thread::class, ['user_id' => auth()->id()]);

        $replies = create(Reply::class, ['thread_id' => $thread->id], 2);

        $best = $replies[1];

        $this->post(route('best-reply.store', ['id' => $best->id]), $best->toArray());

        $this->assertTrue($best->fresh()->isBest);
    }

    public function test_only_thread_creator_may_mark_a_reply_as_best(): void
    {
        $this->signIn();
        $thread = create(Thread::class, ['user_id' => auth()->id()]);

        $replies = create(Reply::class, ['thread_id' => $thread->id], 2);

        $this->signIn(create(User::class));

        $best = $replies[1];

        $this->post(route('best-reply.store', ['id' => $best->id]), $best->toArray())
        ->assertStatus(403);

        $this->assertFalse($best->fresh()->isBest);
    }
}
