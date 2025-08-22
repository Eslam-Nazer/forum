<?php

use Illuminate\Support\Facades\Route;
use Modules\Forum\Http\Controllers\FavoriteController;
use Modules\Forum\Http\Controllers\ReplyController;
use Modules\Forum\Http\Controllers\ThreadController;

Route::controller(ThreadController::class)->group(function () {
    Route::get('threads', 'index')->name('threads.index');
    Route::get('threads/create', 'create')->name('threads.create');
    Route::post('threads', 'store')->name('threads.store');
    Route::get('threads/{channel}/{id}', 'show')->name('threads.show');
    Route::get('threads/{channel?}', 'index')->name('threads.channel');
});

Route::controller(ReplyController::class)->group(function () {
    Route::post('threads/{channel}/{threadId}/replies', 'store')->name('threads.replies.store');
});

Route::controller(FavoriteController::class)->group(function () {
    Route::post('replies/{id}/favorites', 'store')->name('favorite.store');
});

require __DIR__.'/settings.php';
