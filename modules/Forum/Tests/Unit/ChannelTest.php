<?php

namespace Modules\Forum\Tests\Unit;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Modules\Forum\Domain\Models\Channel;
use Modules\Forum\Domain\Models\Thread;
use Tests\TestCase;

class ChannelTest extends TestCase
{
    use DatabaseMigrations;

    public function test_a_channel_consists_of_threads(): void
    {
        $chanel = create(Channel::class);
        $thread = create(Thread::class, ['channel_id' => $chanel->id]);

        $this->assertTrue($chanel->threads->contains($thread));
    }

}
