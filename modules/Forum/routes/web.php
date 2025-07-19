<?php

use Illuminate\Support\Facades\Route;
use Modules\Forum\Http\Controllers\ForumController;
use Modules\Forum\Http\Controllers\ReplyController;
use Modules\Forum\Http\Controllers\ThreadController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('forums', ForumController::class)->names('forum');
});

Route::controller(ThreadController::class)->group(function () {
    Route::get('threads', 'index')->name('threads.index');
    Route::get('threads/{id}', 'show')->name('threads.show');
});

Route::controller(ReplyController::class)->group(function () {
    Route::post('threads/{thread}/replies', 'store')->name('threads.replies.store');
});
