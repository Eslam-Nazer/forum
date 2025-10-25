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
}
