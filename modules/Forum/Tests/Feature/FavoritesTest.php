<?php

namespace Modules\Forum\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Domain\Models\Thread;
use Tests\TestCase;

class FavoritesTest extends TestCase
{
    use DatabaseMigrations;

    public function test_guest_can_not_favorite_anything(): void
    {
        $this->post('favorites/replies/1')
            ->assertRedirect('/login');
    }

    public function test_an_authenticated_user_can_favorite_any_reply(): void
    {
        $this->signIn();
        $reply = create(Reply::class);

        $this->post("favorites/replies/{$reply->id}");

        $this->assertDatabaseHas($reply->getTable(), $reply->getAttributes());
        $this->assertCount(1, $reply->favorites->toArray());
    }

    public function test_an_authenticated_user_may_only_favorite_a_reply_once(): void
    {
        $this->signIn();
        $reply = create(Reply::class);

        try {
            $this->post("favorites/replies/$reply->id")->assertStatus(302);
            $this->post("favorites/replies/$reply->id")->assertStatus(302);
        } catch (Exception $exception) {
            $this->fail($exception->getMessage());
        }

        $this->assertDatabaseHas($reply->getTable(), $reply->getAttributes());
        $this->assertCount(1, $reply->favorites);
    }

    public function test_an_authenticated_user_can_favorite_thread_once(): void
    {
        $this->signIn();

        $thread = create(Thread::class);

        $this->post("favorites/threads/$thread->id")
            ->assertStatus(302);

        $this->assertDatabaseHas('favorites', [
            'user_id' => Auth::id(),
            'favorite_id' => $thread->id,
            'favorite_type' => Thread::class,
        ]);

        $this->post("favorites/threads/{$thread->id}");

        $this->assertCount(1, $thread->favorites);
    }

    public function test_an_authenticated_user_can_unfavorite_a_reply(): void
    {
        $this->signIn();

        $reply = create(Reply::class);

        $this->post("favorites/replies/{$reply->id}")->assertRedirect();

        $this->assertCount(1, $reply->favorites);

        $this->delete("favorites/replies/{$reply->id}")->assertRedirect();

        $this->assertCount(0, $reply->fresh()->favorites);
    }

    public function test_an_authenticated_user_can_unfavorite_a_thread(): void
    {
        $this->signin();

        $thread = create(Thread::class);

        $this->post("favorites/threads/{$thread->id}")->assertRedirect();

        $this->assertCount(1, $thread->favorites);

        $this->delete("favorites/threads/{$thread->id}")->assertRedirect();

        $this->assertCount(0, $thread->fresh()->favorites);
    }
}
