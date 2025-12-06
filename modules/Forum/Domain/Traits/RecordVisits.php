<?php

namespace Modules\Forum\Domain\Traits;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Redis;

trait RecordVisits
{
//    public function visits(): int
//    {
//        return ;
//    }

    public function recordVisits(): void
    {
        Redis::incr($this->visitsCacheKey());
    }

    public function resetVisits(): self
    {
        Redis::del("threads.{$this->id}.visits");

        return $this;
    }

    public function visitsCacheKey(): string
    {
        return "threads.{$this->id}.visits";
    }

    protected function visits(): Attribute
    {
        return Attribute::get(fn (): int => Redis::get("threads.{$this->id}.visits") ?? 0);
    }
}
