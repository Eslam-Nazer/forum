<?php

namespace Modules\Forum\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Domain\Models\Thread;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    public function test_an_authenticated_user_may_participate_in_forum_threads(): void
    {
        $this->signIn();
        $this->assertAuthenticated('web');

        $thread = create(Thread::class, ['user_id' => Auth::id()]);

        $reply = make(Reply::class);

        $this->post($thread->path() . '/replies', $reply->toArray())
            ->assertStatus(302);

        $this->assertEquals(1, $thread->fresh()->replies_count);

        $this->get($thread->path())
            ->assertSee($reply->body)
            ->assertStatus(200);
    }

    public function test_unauthenticated_users_may_not_add_replies(): void
    {
        $this->post('threads/cat/1/replies', [])
            ->assertRedirect('/login');
    }

    public function test_a_reply_requires_a_valid_reply(): void
    {
        $this->signIn();
        $thread = create(Thread::class);
        $reply = make(Reply::class, ['body' => null]);

        $this->post($thread->path() . '/replies', $reply->toArray())
            ->assertSessionHasErrors('body');
    }

    public function test_unauthenticated_users_may_not_delete_replies(): void
    {
        $reply = create(Reply::class);

        $this->delete('replies/' . $reply->id)
            ->assertRedirect('/login');

        $this->signIn()
            ->delete('replies/' . $reply->id)
            ->assertStatus(403);
    }

    public function test_authorized_users_can_delete_replies(): void
    {
        $this->signIn();

        $reply = create(Reply::class, ['user_id' => Auth::id()]);
        $this->delete('replies/' . $reply->id)
            ->assertStatus(302);
        $this->assertDatabaseMissing('replies', $reply->getAttributes());
        $this->assertEquals(0, $reply->thread->fresh()->replies_count);
    }

    public function test_authorize_user_can_update_own_replies(): void
    {
        $repliesOtherUser = create(Reply::class, []);

        $this->patch('replies/' . $repliesOtherUser->id, [])
            ->assertRedirect('login');

        $this->signIn();
        $replies = create(Reply::class, ['user_id' => Auth::id()]);

        $updatedReply = 'You been changed, foo.';

        $this->patch('replies/' . $repliesOtherUser->id, ['body' => $updatedReply])
            ->assertStatus(403);

        $this->patch('replies/' . $replies->id, ['body' => $updatedReply])
            ->assertRedirect();

        $this->assertDatabaseHas('replies', ['id' => $replies->id, 'body' => $updatedReply]);
    }

    public function test_replies_that_contain_spam_may_not_be_created(): void
    {
        $this->signIn();
        $thread = create(Thread::class);

        $reply = make(Reply::class, ['body' => 'aaaaaaaaaaaaaaaaa']);

        $this->post($thread->path() . '/replies', $reply->toArray())
            ->assertStatus(302)
            ->assertSessionHasErrors('body');
    }
}
