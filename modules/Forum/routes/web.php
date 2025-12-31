<?php

use Illuminate\Support\Facades\Route;
use Modules\Forum\Http\Controllers\Api\V1\AvatarController;
use Modules\Forum\Http\Controllers\BestReplyController;
use Modules\Forum\Http\Controllers\FavoriteController;
use Modules\Forum\Http\Controllers\LockThreadsController;
use Modules\Forum\Http\Controllers\RegisterConfirmationController;
use Modules\Forum\Http\Controllers\ReplyController;
use Modules\Forum\Http\Controllers\ThreadController;
use Modules\Forum\Http\Controllers\ThreadSubScriptionController;

Route::prefix('threads')
    ->name('threads.')
    ->group(function () {

        Route::controller(LockThreadsController::class)
            ->name('lock.') // lock
            ->group(function () {
                Route::post('{slug}/lock', 'store')->name('store');
                Route::delete('{slug}/lock', 'destroy')->name('destroy');
            });

        Route::controller(ThreadSubScriptionController::class)
            ->name('subscribe.') // subscribe
            ->group(function () {
                Route::post('/{channel}/{slug}/subscriptions', 'store')->name('store');
                Route::delete('/{channel}/{slug}/subscriptions', 'destroy')->name('destroy');
            });

        // Threads
        Route::get('/', [ThreadController::class, 'index'])->name('index');
        Route::get('t/create', [ThreadController::class, 'create'])->name('create');
        Route::post('/', [ThreadController::class, 'store'])->name('store');
        Route::get('/{channel}/{slug}', [ThreadController::class, 'show'])->name('show');
        Route::get('/{channel?}', [ThreadController::class, 'index'])->name('channel');
        Route::delete('/{channel}/{slug}', [ThreadController::class, 'destroy'])->name('destroy');

    });

// Replies
Route::name('replies.')
    ->controller(ReplyController::class)
    ->group(function () {
        Route::post('threads/{threadSlug}/replies', [ReplyController::class, 'store'])->name('store');
        Route::patch('replies/{id}', [ReplyController::class, 'update'])->name('update');
        Route::delete('replies/{id}', [ReplyController::class, 'destroy'])->name('destroy');

        // best
        Route::name('best.')
            ->controller(BestReplyController::class)
            ->group(function () {
                Route::post('/replies/{id}/best', [BestReplyController::class, 'store'])->name('store');
                Route::delete('/replies/{id}/best', [BestReplyController::class, 'destroy'])->name('destroy');
            });
    });

// Favorites
Route::prefix('favorites/{type}/{id}')
    ->name('favorites.')
    ->controller(FavoriteController::class)
    ->group(function () {
        Route::post('/', [FavoriteController::class, 'store'])
            ->whereIn('type', ['threads', 'replies'])
            ->name('store');

        Route::delete('/', [FavoriteController::class, 'destroy'])
            ->whereIn('type', ['threads', 'replies'])
            ->name('destroy');
    });

// User avatar
Route::post('/api/users/{user}/avatar', [AvatarController::class, 'store'])->name('users.avatar.store');

// Confirmation registration user
Route::get('/register/confirm', [RegisterConfirmationController::class, 'index'])->name('register.confirm');

require __DIR__ . '/users.php';
require __DIR__ . '/settings.php';
