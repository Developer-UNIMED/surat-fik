<?php

use App\Http\Controllers\Web\Arsip\DataSurat\ArsipDataSuratController;
use Illuminate\Support\Facades\Route;

$MIDDLEWARE_ROLE = 'ARSIP';

$middlewares = ['auth', "role:$MIDDLEWARE_ROLE"];
if (session('auth_provider') === 'keycloak') {
    $middlewares[] = 'validate-keycloak-session';
}

Route::prefix("arsip")->middleware($middlewares)->group(function () {
    Route::prefix("data-surat")->controller(ArsipDataSuratController::class)->group(function () {
        Route::get("/", 'index')->name('arsip.index');
    });
});
