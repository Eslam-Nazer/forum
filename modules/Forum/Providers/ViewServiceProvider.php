<?php

namespace Modules\Forum\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     */
    public function register(): void
    {
        View::composer('forum::threads.create', static function ($view) {
            $view->with('channels', \Modules\Forum\Domain\Models\Channel::all());
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
