<?php

namespace Modules\Forum\Tests\Feature;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\TestResponse;
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
        $this->signIn();
        $thread = make(Thread::class, ['user_id' => auth()->id()]);

        $response = $this->post('/threads', $thread->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    // guest
    public function test_a_guest_may_not_create_new_thread(): void
    {
        $this->get('/threads/create')
            ->assertRedirect('/login');

        $this->post('/threads', [])
            ->assertRedirect('/login');
    }

    public function test_a_thread_requires_a_title(): void
    {
        $this->publishThread(['title' => null])->assertSessionHasErrors('title');
    }

    public function test_a_thread_requires_a_body(): void
    {
        $this->publishThread(['body' => null])->assertSessionHasErrors('body');
    }

    public function test_a_thread_requires_a_valid_channel_id(): void
    {
        $this->publishThread(['channel_id' => null])->assertSessionHasErrors('channel_id');
        $this->publishThread(['channel_id' => 999])->assertSessionHasErrors('channel_id');
    }

    public function publishThread(array $overrides = []): TestResponse
    {
        $this->signIn();

        $thread = make(Thread::class, $overrides);

        return $this->post('/threads', $thread->toArray());
    }
}
