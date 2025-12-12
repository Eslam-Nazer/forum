<?php

namespace Modules\Forum\Tests\Feature;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Testing\TestResponse;
use Modules\Forum\Domain\Models\Channel;
use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Domain\Models\Thread;
use Tests\TestCase;

class CreateThreadTest extends TestCase
{
    use DatabaseMigrations;

    // user
    public function test_a_user_can_show_create_thread_page(): void
    {
        $this->signIn();

        $this->get(route('threads.create'))
            ->assertStatus(200);
    }

    public function test_authenticated_users_must_first_confirm_their_email_before_creating_threads(): void
    {
        $this->signIn(User::factory()->unconfirmed()->create());
        $thread = make(Thread::class);

        $this->post(route('threads.store'), $thread->toArray())
            ->assertRedirect(route('threads.index'))
            ->assertSessionHas('messages', [
                'warning' => 'You need to confirm your email before creating a thread.'
            ]);
    }

    public function test_an_authenticated_user_can_create_new_forum_threads(): void
    {
        $this->signIn();
        $thread = make(Thread::class, ['user_id' => auth()->id()]);

        $response = $this->post(route('threads.store'), $thread->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    public function test_a_user_can_remove_an_own_thread(): void
    {
        $this->signIn();
        $thread = create(Thread::class, ['user_id' => auth()->id()]);
        $threadNotOwnUser = create(Thread::class);
        $reply = create(Reply::class, ['thread_id' => $thread->id]);

        $this->assertDatabaseHas('threads', $thread->getAttributes());

        $this->assertDatabaseHas('replies', $reply->getAttributes());

        $this->delete($thread->path());

        $this->assertDatabaseMissing('replies', $reply->getAttributes());

        $this->assertDatabaseMissing('threads', $thread->getAttributes());

        $this->assertDatabaseMissing('activities', ['subject_id' => $thread->id, 'subject_type' => get_class($thread)]);

        $this->assertDatabaseMissing('activities', ['subject_id' => $reply->id, 'subject_type' => get_class($reply)]);

        $this->delete($threadNotOwnUser->path())->assertStatus(403);
    }

    // guest
    public function test_a_guest_may_not_create_new_thread(): void
    {
        $this->get(route('threads.create'))
            ->assertRedirect('/login');

        $this->post(route('threads.store'), [])
            ->assertRedirect(route('login'));
    }

    public function test_a_thread_requires_title_and_body(): void
    {
        $this->signIn();

        $thread = make(Thread::class, ['title' => null]);

        $this->post(route('threads.store'), $thread->toArray())
            ->assertSessionHasErrors('title');

        $thread = make(Thread::class, ['body' => null]);

        $this->post(route('threads.store'), $thread->toArray())
            ->assertSessionHasErrors('body');
    }

    public function test_a_thread_requires_a_valid_channel_id(): void
    {
        $this->signIn();

        $thread = make(Thread::class, ['channel_id' => null]);

        $this->post(route('threads.store'), $thread->toArray())
            ->assertSessionHasErrors('channel_id');

        $thread = make(Thread::class, ['channel_id' => 999]);

        $this->post(route('threads.store'), $thread->toArray())
            ->assertSessionHasErrors('channel_id');
    }

    public function test_guests_cannot_remove_threads(): void
    {
        $thread = create(Thread::class);

        $this->delete($thread->path())->assertRedirect(route('login'));
    }

    public function test_unauthorized_users_cannot_delete_threads(): void
    {
        $thread = create(Thread::class);
        $this->delete($thread->path())->assertRedirect(route('login'));
        $this->signIn();
        $this->delete($thread->path())->assertStatus(403);
    }
}
