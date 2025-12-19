<?php

namespace Modules\Forum\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Forum\Domain\Repositories\Channel\FindChannelRepositoryInterface;
use Modules\Forum\Domain\Repositories\User\FindUserRepositoryInterface;
use Modules\Forum\Domain\Repositories\User\UserRepositoryInterface;
use Modules\Forum\Infrastructure\Repositories\Channel\FindChannelRepository;
use Modules\Forum\Infrastructure\Repositories\Reply\FindReplyRepository;
use Modules\Forum\Domain\Repositories\Reply\FindReplyRepositoryInterface;
use Modules\Forum\Infrastructure\Repositories\Thread\ThreadsRepository;
use Modules\Forum\Infrastructure\Repositories\Thread\FindThreadRepository;
use Modules\Forum\Domain\Repositories\Thread\ThreadsRepositoryInterface;
use Modules\Forum\Domain\Repositories\Thread\FindThreadRepositoryInterface;
use Modules\Forum\Infrastructure\Repositories\Thread\StoreThreadRepository;
use Modules\Forum\Domain\Repositories\Thread\StoreThreadRepositoryInterface;
use Modules\Forum\Infrastructure\Repositories\Favorite\StoreFavoriteRepository;
use Modules\Forum\Domain\Repositories\Favorite\StoreFavoriteRepositoryInterface;
use Modules\Forum\Infrastructure\Repositories\Favorite\DestroyFavoriteRepository;
use Modules\Forum\Domain\Repositories\Favorite\DestroyFavoriteRepositoryInterface;
use Modules\Forum\Infrastructure\Repositories\Reply\StoreReplyRepository;
use Modules\Forum\Domain\Repositories\Reply\StoreReplyRepositoryInterface;
use Modules\Forum\Infrastructure\Repositories\Thread\Filters\FilterThreadsRepository;
use Modules\Forum\Domain\Repositories\Thread\Filters\FilterThreadsRepositoryInterface;
use Modules\Forum\Infrastructure\Repositories\User\FindUserRepository;
use Modules\Forum\Infrastructure\Repositories\User\UserRepository;

class BindServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        // thread
        $this->app->bind(StoreThreadRepositoryInterface::class, StoreThreadRepository::class);
        $this->app->bind(FindThreadRepositoryInterface::class, FindThreadRepository::class);
        $this->app->bind(ThreadsRepositoryInterface::class, ThreadsRepository::class);
        $this->app->bind(FilterThreadsRepositoryInterface::class, FilterThreadsRepository::class);
        // reply
        $this->app->bind(StoreReplyRepositoryInterface::class, StoreReplyRepository::class);
        $this->app->bind(FindReplyRepositoryInterface::class, FindReplyRepository::class);
        // favorite
        $this->app->bind(StoreFavoriteRepositoryInterface::class, StoreFavoriteRepository::class);
        $this->app->bind(DestroyFavoriteRepositoryInterface::class, DestroyFavoriteRepository::class);
        // user
        $this->app->bind(FindUserRepositoryInterface::class, FindUserRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        // channel
        $this->app->bind(FindChannelRepositoryInterface::class, FindChannelRepository::class);
    }
}
