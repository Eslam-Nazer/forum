<?php

namespace Modules\Forum\Tests\Feature;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Modules\Forum\Domain\Models\Channel;
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
        $user = auth()->user();

        $thread = create(Thread::class, ['user_id' => $user->id]);

        $reply = make(Reply::class);

        $this->post($thread->path() . '/replies', $reply->toArray())
        ->assertStatus(302);

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
}
