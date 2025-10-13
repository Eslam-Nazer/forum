<?php

namespace Modules\Forum\Tests\Feature;

use App\Models\User;
use Modules\Forum\Domain\Models\Channel;
use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Domain\Models\Thread;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;

class ReadThreadTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * A basic test example.
     */
    public function test_a_user_can_view_all_threads(): void
    {
        $this->signIn();
        $threads = create(Thread::class);
        $response = $this->get('/threads');
        $response->assertSee($threads->title);
        $response->assertStatus(200);
    }

    public function test_a_user_can_view_a_single_thread(): void
    {
        $this->signIn();
        $thread = create(Thread::class);
        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertStatus(200);
    }

    public function test_a_user_can_see_replies_in_thread(): void
    {
        $this->signIn();
        $thread = create(Thread::class);
        $reply = Reply::factory()->create(['thread_id' => $thread->id]);
        $this->get($thread->path())
            ->assertSee($reply->body)
            ->assertStatus(200);
    }

    public function test_a_user_can_filter_threads_by_channel(): void
    {
        $this->signIn();
        $channel = create(Channel::class);
        $threadInChannel = create(Thread::class, ['channel_id' => $channel->id]);
        $threadNotInChannel = create(Thread::class);

        $this->get('/threads/' . $channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }

    public function test_a_user_can_filter_threads_by_any_username(): void
    {
        $this->signIn(create(User::class, ['name' => 'EslamNazer']));

        $threadInChannel = create(Thread::class, ['user_id' => Auth::id()]);
        $threadNotInChannel = create(Thread::class);

        $this->get('/threads?by=EslamNazer')
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadNotInChannel->title);
    }

    public function test_a_user_can_filter_threads_by_popularity(): void
    {
        $this->signIn();
        $threadWithThreeReplies = create(Thread::class);
        create(Reply::class, ['thread_id' => $threadWithThreeReplies->id], 3);

        $threadWithTwoReplies = create(Thread::class);
        create(Reply::class, ['thread_id' => $threadWithTwoReplies->id], 2);

        $threadsWithNoReplies = create(Thread::class);

        $response = $this->getJson('threads?popular')->json();

        $this->assertEquals([3, 2, 0], array_column($response['data'], 'replies_count'));
    }


    public function test_a_user_can_filter_threads_by_unanswered(): void
    {
        $this->signIn();
        $this->assertAuthenticated();
        $thread = create(Thread::class);
        create(Reply::class, ['thread_id' => $thread->id]);
        create(Thread::class);

        $response = $this->getJson('threads?unanswered=1')->json();

        $this->assertCount(1, $response['data']);
    }
}
