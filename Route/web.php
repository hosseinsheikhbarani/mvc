<?php

use lil\App\Controlers\HomeController;
use lil\App\Core\Route;


Route::get('/', [HomeController::class, 'home']);

Route::prefix(ADMINADDRESS)->group(function () {
    Route::any('/', [HomeController::class, 'home']);
});
