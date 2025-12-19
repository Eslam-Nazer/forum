<?php

namespace Modules\Forum\Domain\Repositories\Channel;

use Modules\Forum\Domain\Models\Channel;

interface FindChannelRepositoryInterface
{
    /**
     * Handle query to find channel
     *
     * @param string|null $channel_id
     * @param string|null $channel_slug
     * @return Channel
     */
    public function handle(?string $channel_id, ?string $channel_slug): Channel;
}
