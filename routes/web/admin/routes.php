<?php

use App\Http\Controllers\Web\Admin\Dashboard\AdminDashboardController;
use App\Http\Controllers\Web\Admin\JenisSurat\AdminJenisSuratController;
use Illuminate\Support\Facades\Route;

$MIDDLEWARE_ROLE = 'ADMIN';

$middlewares = ['auth', "role:$MIDDLEWARE_ROLE"];
if (session('auth_provider') === 'keycloak') {
    $middlewares[] = 'validate-keycloak-session';
}

Route::prefix("admin")->middleware($middlewares)->group(function () {
    Route::get("/", [AdminDashboardController::class, 'index'])->name('admin.index');

    Route::prefix("jenis-surat")->controller(AdminJenisSuratController::class)->group(function () {
        Route::get("/", 'index')->name('admin.jenis-surat.index');
        Route::get("/create", 'create')->name('admin.jenis-surat.create');
        Route::post('/', 'store')->name('admin.jenis-surat.store');
        Route::post('/delete/{id}', 'delete')->name('admin.jenis-surat.delete');
    });
});

//Route::get('admin/download', function () {
//    return Storage::download('jenis_surat/01J3A3720T4W6VB4BK2WATGBYT-file.pdf', 'FILE_FORMAT.pdf');
//});
