<?php

namespace Modules\Forum\Tests\Unit;

use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Modules\Forum\Domain\Models\Reply;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    public function test_a_user_can_fetch_their_most_recent_reply(): void
    {
        $user = create(User::class);

        $reply = create(Reply::class, ['user_id' => $user->id]);

        $this->assertEquals($reply->id, $user->lastReply->id);
    }
}
