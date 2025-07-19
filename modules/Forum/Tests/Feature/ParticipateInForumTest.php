<?php

namespace Modules\Forum\Tests\Feature;

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Domain\Models\Thread;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();
        $this->thread = Thread::factory()->create();
    }

    public function test_an_authenticated_user_may_participate_in_forum_threads(): void
    {
        $this->be($user = User::factory()->create());
        $this->assertAuthenticated('web');

        $reply = Reply::factory()->create();
        $this->post($this->thread->path() .'/replies', $reply->toArray())
        ->assertStatus(302);

        $this->get($this->thread->path())
        ->assertSee($reply->body)
        ->assertSee($reply->created_at->diffForHumans())
        ->assertStatus(200);
    }

    public function test_unauthenticated_users_may_not_add_replies(): void
    {
        $this->post($this->thread->path() . '/replies', [])
            ->assertRedirect('/login');
    }
}
