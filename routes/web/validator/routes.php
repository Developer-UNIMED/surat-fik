<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Validator\SuratMasuk\ValidatorSuratMasukController;

$MIDDLEWARE_ROLE = 'WD1,WD2,WD3,DEKAN';

$middlewares = ['auth', "role:$MIDDLEWARE_ROLE"];
if (session('auth_provider') === 'keycloak') {
    $middlewares[] = 'validate-keycloak-session';
}

Route::prefix("validator")->middleware($middlewares)->group(function () {

    Route::prefix("surat-masuk")->controller(ValidatorSuratMasukController::class)->group(function () {
        Route::get("/", 'index')->name('validator.index');
        Route::post("/", 'store')->name('validator.store');
    });
});
