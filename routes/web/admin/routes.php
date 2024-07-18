<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\Admin\Dashboard\AdminDashboardController;
use App\Http\Controllers\Web\Admin\JenisSurat\AdminJenisSuratController;

$MIDDLEWARE_ROLE = 'ADMIN';

$middlewares = ['auth', "role:$MIDDLEWARE_ROLE"];
if (session('auth_provider') === 'keycloak') {
    $middlewares[] = 'validate-keycloak-session';
}

Route::prefix("admin")->middleware($middlewares)->group(function () {
    Route::get("/", [AdminDashboardController::class, 'index'])->name('admin.index');

    Route::prefix("jenis-surat")->controller(AdminJenisSuratController::class)->group(function () {
        Route::get("/", 'index')->name('admin.jenis-surat.index');
    });
});
