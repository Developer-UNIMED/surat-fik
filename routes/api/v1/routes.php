<?php

use Illuminate\Support\Facades\Route;

require __DIR__ . "/auth/routes.php";

Route::get('/ping', function () {
    return response()->json(['message' => 'pong']);
});
