<?php

use Illuminate\Support\Facades\Route;
use Modules\Forum\Http\Controllers\Api\V1\AvatarController;
use Modules\Forum\Http\Controllers\Settings\ActivityController;
use Modules\Forum\Http\Controllers\Settings\ReplyController;
use Modules\Forum\Http\Controllers\Settings\ThreadController;


Route::controller(ThreadController::class)->group(function () {
    Route::get('settings/threads', 'index')->name('settings.threads.index');
});

Route::controller(ActivityController::class)->group(function () {
    Route::get('settings/activities', 'index')->name('settings.activity.index');
});

Route::controller(ReplyController::class)->group(function () {
    Route::get('settings/replies', 'index')->name('settings.reply.index');
});

Route::controller(AvatarController::class)->group(function () {
    Route::get('settings/avatar', 'index')->name('settings.avatar.index');
});
