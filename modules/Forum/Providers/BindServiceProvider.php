<?php

namespace Modules\Forum\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Forum\Domain\Repositories\Favorite\CreateFavoriteRepositoryInterface;
use Modules\Forum\Domain\Repositories\Reply\UserAddReplyInThreadRepositoryInterface;
use Modules\Forum\Domain\Repositories\Thread\AllThreadsRepositoryInterface;
use Modules\Forum\Domain\Repositories\Thread\CreateThreadRepositoryInterface;
use Modules\Forum\Domain\Repositories\Thread\DeleteThreadRepositoryInterface;
use Modules\Forum\Domain\Repositories\Thread\Filters\FilterThreadsRepositoryInterface;
use Modules\Forum\Domain\Repositories\Thread\FindThreadRepositoryInterface;
use Modules\Forum\Infrastructure\Repositories\Favorite\CreateFavoriteRepository;
use Modules\Forum\Infrastructure\Repositories\Reply\UserAddReplyInThreadRepository;
use Modules\Forum\Infrastructure\Repositories\Thread\AllThreadsRepository;
use Modules\Forum\Infrastructure\Repositories\Thread\CreateThreadRepository;
use Modules\Forum\Infrastructure\Repositories\Thread\DeleteThreadRepository;
use Modules\Forum\Infrastructure\Repositories\Thread\Filters\FilterThreadsRepository;
use Modules\Forum\Infrastructure\Repositories\Thread\FindThreadRepository;

class BindServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->bind(UserAddReplyInThreadRepositoryInterface::class, UserAddReplyInThreadRepository::class);
        $this->app->bind(CreateThreadRepositoryInterface::class, CreateThreadRepository::class);
        $this->app->bind(FindThreadRepositoryInterface::class, FindThreadRepository::class);
        $this->app->bind(AllThreadsRepositoryInterface::class, AllThreadsRepository::class);
        $this->app->bind(FilterThreadsRepositoryInterface::class, FilterThreadsRepository::class);
        $this->app->bind(CreateFavoriteRepositoryInterface::class, CreateFavoriteRepository::class);
    }
}
