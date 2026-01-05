<?php

namespace Modules\Forum\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Forum\Domain\Models\Channel;
use Modules\Forum\Domain\Models\Thread;
use Tests\TestCase;

class UpdateThreadsTest extends TestCase
{
    use RefreshDatabase;

    public function test_unauthorize_user_can_not_update_thread(): void
    {
        $this->signIn();

        $thread = create(Thread::class);

        $this->patch(
            route('threads.update', [
                'channel' => $thread->channel->slug,
                'slug' => $thread->slug,
            ]),
            [
                'title' => 'Update Title',
            ]
        )
            ->assertStatus(403);
    }

    public function test_authorize_user_can_not_update_thread_if_not_changed(): void
    {
        $this->signIn();

        $thread = create(Thread::class, ['user_id' => auth()->id()]);

        $this->patch(
            route('threads.update', [
                'channel' => $thread->channel->slug,
                'slug' => $thread->slug,
            ]),
            [
                'title' => $thread->title,
                'channel_id' => $thread->channel->id,
                'body' => $thread->body,
            ]
        )
            ->assertSessionHasErrors('no_change');
    }

    public function test_authorized_user_can_update_thread(): void
    {
        $this->signIn();
        $thread = create(Thread::class, ['user_id' => auth()->id()]);
        $channel = create(Channel::class);

        $this->patch(
            route('threads.update', [
                'channel' => $thread->channel->slug,
                'slug' => $thread->slug,
            ]),
            [
                'title' => 'Update Title',
                'channel_id' => $channel->id,
                'body' => 'Update Body',
            ]
        );

        tap($thread->fresh(), function (Thread $thread) use ($channel) {
            $this->assertEquals('Update Title', $thread->title);
            $this->assertEquals($channel->id, $thread->channel->id);
            $this->assertEquals('Update Body', $thread->body);
        });
    }
}
