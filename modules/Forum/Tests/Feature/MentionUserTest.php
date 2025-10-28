<?php

namespace Modules\Forum\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Domain\Models\Thread;
use Tests\TestCase;

class MentionUserTest extends TestCase
{
    use DatabaseMigrations;

    public function test_mentioned_users_in_a_reply_are_notified(): void
    {
        $john = create(User::class, ['name' => 'JohnDoe']);

        $this->actingAs($john);

        $poe = create(User::class, ['name' => 'PoeDoe']);

        $thread = create(Thread::class);

        $reply = make(Reply::class, [
            'body' => '@PoeDoe look at this.'
        ]);

        $this->post($thread->path() . '/replies', $reply->toArray());

        $this->assertCount(1, $poe->notifications);
    }
}
