<?php

namespace Modules\Forum\Tests\Feature;

use App\Models\User;
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
        $this->thread = Thread::factory()->create();
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

        $response = $this->get($this->thread->path());
        $response->assertSee($this->thread->title);
        $response->assertStatus(200);
    }

    public function test_a_user_can_see_replies_in_thread(): void
    {
        $reply = Reply::factory()->create(['thread_id' => $this->thread->id]);
        $this->get($this->thread->path())
            ->assertSee($reply->body)
            ->assertStatus(200);
    }
}
