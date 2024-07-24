<?php

use Illuminate\Support\Facades\Route;

if (in_array('keycloak', config('auth.provider'))) {
    require __DIR__ . "/web/auth/keycloak.php";
}

if (in_array('database', config('auth.provider'))) {
    require __DIR__ . "/web/auth/database.php";
}

require __DIR__ . "/web/admin/routes.php";
require __DIR__ . "/web/user/routes.php";
require __DIR__ . "/web/validator/routes.php";

Route::view('/', 'welcome')->name('index');
