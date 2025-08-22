<?php

use Illuminate\Support\Facades\Route;
use Modules\Forum\Http\Controllers\Settings\ThreadController;


Route::controller(ThreadController::class)->group(function () {
    Route::get('settings/threads', 'index')->name('settings.threads.index');
});
