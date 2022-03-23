<?php

use lil\App\Controlers\HomeController;
use lil\App\Core\Route;

Route::get('/', [HomeController::class, 'home']);

Route::prefix('api')->group(function () {
    Route::any('test', [HomeController::class, 'test']);
});
