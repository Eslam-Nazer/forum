<?php

namespace Modules\Forum\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        View::composer('*', static function ($view) {
            $channels =Cache::rememberForever('forum.channels', static function () {
                return \Modules\Forum\Domain\Models\Channel::all();
            });
            $view->with('channels', $channels);
        });
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }
}
