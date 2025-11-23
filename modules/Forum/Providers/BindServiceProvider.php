<?php

namespace Modules\Forum\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Forum\Domain\Repositories\User\FindUserRepositoryInterface;
use Modules\Forum\Infrastructure\Repositories\Reply\FindReplyRepository;
use Modules\Forum\Domain\Repositories\Reply\FindReplyRepositoryInterface;
use Modules\Forum\Infrastructure\Repositories\Thread\AllThreadsRepository;
use Modules\Forum\Infrastructure\Repositories\Thread\FindThreadRepository;
use Modules\Forum\Domain\Repositories\Thread\AllThreadsRepositoryInterface;
use Modules\Forum\Domain\Repositories\Thread\FindThreadRepositoryInterface;
use Modules\Forum\Infrastructure\Repositories\Thread\CreateThreadRepository;
use Modules\Forum\Domain\Repositories\Thread\CreateThreadRepositoryInterface;
use Modules\Forum\Infrastructure\Repositories\Favorite\CreateFavoriteRepository;
use Modules\Forum\Domain\Repositories\Favorite\CreateFavoriteRepositoryInterface;
use Modules\Forum\Infrastructure\Repositories\Favorite\DestroyFavoriteRepository;
use Modules\Forum\Domain\Repositories\Favorite\DestroyFavoriteRepositoryInterface;
use Modules\Forum\Infrastructure\Repositories\Reply\StoreReplyRepository;
use Modules\Forum\Domain\Repositories\Reply\StoreReplyRepositoryInterface;
use Modules\Forum\Infrastructure\Repositories\Thread\Filters\FilterThreadsRepository;
use Modules\Forum\Domain\Repositories\Thread\Filters\FilterThreadsRepositoryInterface;
use Modules\Forum\Infrastructure\Repositories\User\FindUserRepository;

class BindServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->bind(StoreReplyRepositoryInterface::class, StoreReplyRepository::class);
        $this->app->bind(CreateThreadRepositoryInterface::class, CreateThreadRepository::class);
        $this->app->bind(FindThreadRepositoryInterface::class, FindThreadRepository::class);
        $this->app->bind(AllThreadsRepositoryInterface::class, AllThreadsRepository::class);
        $this->app->bind(FilterThreadsRepositoryInterface::class, FilterThreadsRepository::class);
        $this->app->bind(CreateFavoriteRepositoryInterface::class, CreateFavoriteRepository::class);
        $this->app->bind(FindReplyRepositoryInterface::class, FindReplyRepository::class);
        $this->app->bind(DestroyFavoriteRepositoryInterface::class, DestroyFavoriteRepository::class);
        $this->app->bind(FindUserRepositoryInterface::class, FindUserRepository::class);
    }
}
