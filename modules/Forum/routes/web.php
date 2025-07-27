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
    Route::get('threads/create', 'create')->name('threads.create');
    Route::post('threads', 'store')->name('threads.store');
    Route::get('threads/{slug}/{id}', 'show')->name('threads.show');
});

Route::controller(ReplyController::class)->group(function () {
    Route::post('threads/{channel}/{thread}/replies', 'store')->name('threads.replies.store');
});
