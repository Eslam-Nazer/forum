<?php

namespace Modules\Forum\Infrastructure\Cache;

use Illuminate\Support\Facades\Redis;
use Modules\Forum\Domain\Models\Thread;

class Visits
{
    /**
     * @param Thread $thread
     */
    public function __construct(
      protected Thread $thread
    ) {}

    /**
     * @return string
     */
    public function cacheKey(): string
    {
        return "threads.{$this->thread->id}.visits";
    }

    /**
     * @return void
     */
    public function record(): void
    {
        Redis::incr($this->cacheKey());
    }

    /**
     * @return $this
     */
    public function reset(): self
    {
        Redis::del($this->cacheKey());

        return $this;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return Redis::get($this->cacheKey()) ?? 0;
    }
}
