<?php

namespace Modules\Forum\Infrastructure\Repositories\Channel;

use Modules\Forum\Domain\Models\Channel;
use Modules\Forum\Domain\Repositories\Channel\FindChannelRepositoryInterface;

class FindChannelRepository implements FindChannelRepositoryInterface
{
    /**
     * @param string|null $channel_id
     * @param string|null $channel_slug
     * @return Channel
     */
    public function handle(?string $channel_id = null, ?string $channel_slug = null): Channel
    {
        $channel = Channel::query();

        $channel->when($channel_slug, function ($query, $channel_slug) {
            $query->where('slug', $channel_slug);
        })->when($channel_id, function ($query, $channel_id) {
            $query->where('id', $channel_id);
        });

        return $channel->firstOrFail();
    }
}
