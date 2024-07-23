<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\User\SuratBaru\UserSuratBaruController;
use App\Http\Controllers\Web\User\RiwayatSurat\UserRiwayatSuratController;
use App\Http\Controllers\Web\User\TemplateSurat\UserTemplateSuratController;

$MIDDLEWARE_ROLE = 'USER';

$middlewares = ['auth', "role:$MIDDLEWARE_ROLE"];
if (session('auth_provider') === 'keycloak') {
    $middlewares[] = 'validate-keycloak-session';
}

Route::prefix('user')->middleware($middlewares)->group(function () {

    Route::prefix('/template-surat')->controller(UserTemplateSuratController::class)->group(function () {
        Route::get('/', 'index')->name('user.index');
    });

    Route::prefix('/surat-baru')->controller(UserSuratBaruController::class)->group(function () {
        Route::get('/', 'index')->name('user.surat-baru.index');
    });

    Route::prefix('/riwayat-surat')->controller(UserRiwayatSuratController::class)->group(function () {
        Route::get('/', 'index')->name('user.riwayat-surat.index');
    });
});
