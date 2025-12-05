<?php

namespace Modules\Forum\Infrastructure\Cache;

use Illuminate\Support\Facades\Redis;
use JsonException;
use Modules\Forum\Domain\Models\Thread;

class Trending
{
    /**
     * @return array
     */
    public function get(): array
    {
        return array_map('json_decode', Redis::zrevrange($this->cacheKey(), 0, 4));
    }

    /**
     * @throws JsonException
     */
    public function push(Thread $thread): void
    {
        Redis::zincrby($this->cacheKey(), 1, json_encode([
            'title' => $thread->title,
            'slug'  => $thread->channel->slug,
            'path'  => $thread->path()
        ], JSON_THROW_ON_ERROR));
    }

    public function cacheKey(): string
    {
        return app()->environment('testing') ? 'testing_trending_threads' : 'trending_threads';
    }

    public function reset(): void
    {
        Redis::del($this->cacheKey());
    }
}
