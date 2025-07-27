<?php

namespace Modules\Forum\Tests\Feature;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Modules\Forum\Domain\Models\Channel;
use Modules\Forum\Domain\Models\Thread;
use Tests\TestCase;

class CreateThreadTest extends TestCase
{
    use DatabaseMigrations;

    // user
    public function test_a_user_can_show_create_thread_page(): void
    {
        $this->signIn();

        $this->get('/threads/create')
            ->assertStatus(200);
    }

    public function test_an_authenticated_user_can_create_new_forum_threads(): void
    {
//        $this->actingAs(User::factory()->create());
//        $this->actingAs(create(User::class));
        $this->signIn();
//        $thread = Thread::factory()->make(['user_id' => auth()->id()]);
        $channel = create(Channel::class);
        $thread = create(Thread::class, ['user_id' => auth()->id(), 'channel_id' => $channel->id]);

        $this->post('/threads', $thread->toArray());

        $this->assertDatabaseHas('threads', $thread->toArray());

        logger()->info($thread->path());
        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    // guest
    public function test_a_guest_cannot_show_create_thread_page(): void
    {
        $this->get('/threads/create')
            ->assertRedirect('/login');
    }

    public function test_a_guest_cannot_create_threads(): void
    {
        $this->post('/threads', [])
            ->assertRedirect('/login');
    }
}
