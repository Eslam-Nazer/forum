<?php

namespace Modules\Forum\Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Bus;
use Modules\Forum\Domain\Models\Reply;
use Modules\Forum\Domain\Models\Thread;
use Tests\TestCase;

class MentionUserTest extends TestCase
{
    use DatabaseMigrations;

    public function test_mentioned_users_in_a_reply_are_notified(): void
    {
        Bus::fake();
        $john = create(User::class, ['name' => 'JohnDoe']);

        $this->actingAs($john)->withoutExceptionHandling();

        $poe = create(User::class, ['name' => 'PoeDoe']);

        $thread = create(Thread::class);

        $reply = make(Reply::class, [
            'body' => '@PoeDoe look at this.'
        ]);

        $this->post(route('replies.store', [
            'threadSlug' => $thread->slug
        ]), $reply->toArray());

        $this->assertCount(1, $poe->notifications);
    }
}
