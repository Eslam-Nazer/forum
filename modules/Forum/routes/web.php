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
        //lock threads
//        Route::
    });

// lock threads
Route::post('/threads/{slug}/lock', [LockThreadsController::class, 'store'])->name('lock-threads.store');
Route::delete('/threads/{slug}/lock', [LockThreadsController::class, 'destroy'])->name('lock-threads.destroy');
// subscriptions in threads
Route::post('threads/{channel}/{slug}/subscriptions', [ThreadSubScriptionController::class, 'store'])->name('threads.subscribe.store');
Route::delete('threads/{channel}/{slug}/subscriptions', [ThreadSubScriptionController::class, 'destroy'])->name('threads.subscribe.destroy');
// Threads
Route::get('threads', [ThreadController::class, 'index'])->name('threads.index');
Route::get('threads/create', [ThreadController::class, 'create'])->name('threads.create');
Route::post('threads', [ThreadController::class, 'store'])->name('threads.store');
Route::get('threads/{channel}/{slug}', [ThreadController::class, 'show'])->name('threads.show');
Route::get('threads/{channel?}', [ThreadController::class, 'index'])->name('threads.channel');
Route::delete('threads/{channel}/{slug}', [ThreadController::class, 'destroy'])->name('threads.destroy');
// Replies
Route::post('threads/{threadSlug}/replies', [ReplyController::class, 'store'])->name('replies.store');
Route::patch('replies/{id}', [ReplyController::class, 'update'])->name('replies.update');
Route::delete('replies/{id}', [ReplyController::class, 'destroy'])->name('replies.destroy');
// Best replies
Route::post('/replies/{id}/best', [BestReplyController::class, 'store'])->name('best-reply.store');
Route::delete('/replies/{id}/best', [BestReplyController::class, 'destroy'])->name('best-reply.destroy');
// Favorites
Route::post('favorites/{type}/{id}', [FavoriteController::class, 'store'])
    ->whereIn('type', ['threads', 'replies'])
    ->name('favorite.store');

Route::delete('favorites/{type}/{id}', [FavoriteController::class, 'destroy'])
    ->whereIn('type', ['threads', 'replies'])
    ->name('favorite.destroy');
// User avatar
Route::post('/api/users/{user}/avatar', [AvatarController::class, 'store'])->name('users.avatar.store');
// Confirmation registration user
Route::get('/register/confirm', [RegisterConfirmationController::class, 'index'])->name('register.confirm');

require __DIR__ . '/users.php';
require __DIR__ . '/settings.php';
