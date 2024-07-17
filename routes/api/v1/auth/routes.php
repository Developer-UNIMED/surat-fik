<?php

use Illuminate\Support\Facades\Route;

Route::prefix("/auth")->group(function () {
    Route::middleware("guest")->group(function () {
//        Route::post("/login", APISignInController::class)->name("api.auth.login");
//        Route::post("/register", APISignInController::class)->name("api.auth.register");
    });

    Route::middleware("auth")->group(function () {
//        Route::post("/logout", APISignOutController::class)->name("api.auth.logout");
    });
});
