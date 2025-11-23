<?php


use Illuminate\Support\Facades\Route;
use Modules\Forum\Http\Controllers\Users\UserController;

Route::controller(UserController::class)->group(static function () {
    Route::get('/{name}/profile', 'show')->name('profile.show');
});
