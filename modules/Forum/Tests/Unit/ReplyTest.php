<?php

namespace Modules\Forum\Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Modules\Forum\Domain\Models\Reply;
use Tests\TestCase;

class ReplyTest extends TestCase
{
    use DatabaseMigrations;

    public function test_reply_has_owner(): void
    {
        $reply = Reply::factory()->create();

        $this->assertInstanceOf(User::class, $reply->owner);
    }

    public function test_knows_if_it_was_just_published(): void
    {
        $reply = create(Reply::class);

        $this->assertTrue($reply->wasJustPublished());

        $reply->created_at = now()->subMinute();

        $this->assertFalse($reply->wasJustPublished());
    }

    public function test_can_detect_all_mentioned_users_in_the_body(): void
    {
        $reply = new Reply([
            'body' => '@janeDoe mentioned you in @JohnDoe'
        ]);

        $this->assertEquals(['janeDoe', 'JohnDoe'], $reply->mentionedUsers());
    }

    public function test_wrap_mentioned_usernames_in_the_body_within_anchor_tag(): void
    {
        $reply = new Reply(['body' => '@janeDoe mentioned you in @JohnDoe.']);

        $this->assertEquals(
            '<a class="text-blue-400" href="/janeDoe/profile">@janeDoe</a> mentioned you in <a class="text-blue-400" href="/JohnDoe/profile">@JohnDoe</a>.',
            $reply->body
        );
    }
}
