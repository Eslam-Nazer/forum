<?php

namespace Modules\Forum\Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Redis;
use Modules\Forum\Domain\Models\Thread;
use Tests\TestCase;

class TrendingThreadTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp(): void
    {
        parent::setUp();

        Redis::del('trending_threads');
    }

    public function test_increment_a_thread_score_each_time_it_is_read(): void
    {
        $this->signIn();
        $this->assertEmpty(Redis::zrange('trending_threads', 0, -1));

        $thread = create(Thread::class);

        $this->call('GET', $thread->path());

        $trending = Redis::zrange('trending_threads', 0, -1);

        $this->assertCount(1, $trending);

        $this->assertEquals($thread->title, json_decode($trending[0])->title);

        Redis::del('trending_threads');
    }
}
