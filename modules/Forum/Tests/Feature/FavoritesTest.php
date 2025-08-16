<?php

namespace Modules\Forum\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Mockery\Exception;
use Modules\Forum\Domain\Models\Reply;
use Tests\TestCase;

class FavoritesTest extends TestCase
{
    use DatabaseMigrations;

    public function test_guest_can_not_favorite_anything(): void
    {
        $this->post('/replies/1/favorites')
            ->assertRedirect('/login');
    }

    public function test_an_authenticated_user_can_favorite_any_reply(): void
    {
        $this->signIn();
        $reply = create(Reply::class);

        $this->post('/replies/' . $reply->id . '/favorites');

        $this->assertDatabaseHas($reply->getTable(), $reply->getAttributes());
        $this->assertCount(1, $reply->favorites->toArray());
    }

    public function test_an_authenticated_user_may_only_favorite_a_reply_once(): void
    {
        $this->signIn();
        $reply = create(Reply::class);

        try {
            $this->post('/replies/' . $reply->id . '/favorites')->assertStatus(302);
            $this->post('/replies/' . $reply->id . '/favorites')->assertStatus(302);
        } catch (Exception $exception) {
            $this->fail($exception->getMessage());
        }

        $this->assertDatabaseHas($reply->getTable(), $reply->getAttributes());
        $this->assertCount(1, $reply->favorites);
    }
}
