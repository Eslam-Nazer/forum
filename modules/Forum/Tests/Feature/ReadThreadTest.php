<?php

namespace Modules\Forum\Tests\Feature;

use App\Models\User;
use Modules\Forum\Domain\Models\Channel;
use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Domain\Models\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReadThreadTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->thread = create(Thread::class);
    }

    /**
     * A basic test example.
     */
    public function test_a_user_can_view_all_threads(): void
    {
        $response = $this->get('/threads');

        $response->assertSee($this->thread->title);
        $response->assertStatus(200);
    }

    public function test_a_user_can_view_a_single_thread(): void
    {
        $this->get($this->thread->path())
            ->assertSee($this->thread->title)
            ->assertStatus(200);
    }

    public function test_a_user_can_see_replies_in_thread(): void
    {
        $reply = Reply::factory()->create(['thread_id' => $this->thread->id]);
        $this->get($this->thread->path())
            ->assertSee($reply->body)
            ->assertStatus(200);
    }

    public function test_a_user_can_filter_threads_by_channel(): void
    {
        $channel = create(Channel::class);
        $threadInChannel = create(Thread::class, ['channel_id' => $channel->id]);
        $threadNotInChannel = create(Thread::class);

        $this->get('/threads/' . $channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title)
            ->assertStatus(200);
    }

    public function test_a_user_can_filter_threads_by_any_username(): void
    {
        $this->signIn(create(User::class, ['name' => 'EslamNazer']));

        $threadInChannel = create(Thread::class, ['user_id' => auth()->id()]);
        $threadNotInChannel = create(Thread::class);

        $this->get('/threads?by=EslamNazer')
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }
}
